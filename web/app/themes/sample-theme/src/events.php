<?php
/**
 * Functions to process events data
 *
 * Note there is currently some logic in the ajax.php file
 */

namespace Events;

use Roots\Sage\App;

/**
 * JSON for events
 *
 * This does NOT process the raw data from the ajax post, refer to process_event()
 *
 * @param string $action Form action for CRM
 * @param string $type Form type
 * @param array $data Form details
 * @param string $session ID from cookie
 *
 * @value string requestUUID prevent duplicate processing (append timestamp?)
 * @value string requestOrigin GLOBAL/JAPAN/CHINA set in ENV
 * @value string requestorIpAddress User's IP address
 * @value string requestorLocale EN/JP etc set in ENV
 * @value string requestorUserId Retrieve from WP if available, else 0
 */
function process_event_json($data)
{
    $json = array(
      'Event' => array(
        'IpSource' => 2,
        'EventTypeCode' => $data['eventTypeCode'],
        'EventCode' => $data['eventCode'],
        'GMTDateTime' => gmdate('Ymdhis'),
        'EventDate' => gmdate('m-d-Y'),
        'EventTime' => time() - strtotime('today'),
        'EventData' => array(
          'Browser' => $data['browser'],
          'ContactType' => $data['contactType'],
          'Company' => $data['company'],
          'Country' => $data['country'],
          'CalledFrom' => $data['referrer'],
          'Email' => $data['email'],
          'FirstName' => $data['firstName'],
          'LastName' => $data['lastName'],
          'Locale' => $data['locale'],
          'PageContents' => $data['slug'],
          'PageContentId' => get_post_id($data['slug']),
          'PersonName' => 'Guest',
          'PersonType' => 'HUMAN',
          'Phone' => $data['phone'],
          'SessionId' => $data['userID'],
          'UserId' => $data['userID'],
          'ViewerIpAddress' =>  isset($data['ipAddress']) ? $data['ipAddress'] : null,
        ),
        'SessionId' => get_host_ip(),
        'UnitId' => 59010,
        'ReferenceId' => '373737'
      ),
    );

    // Only add video data if it is present in the event
    if ($data['eventCode'] == 'VIDEO') {
        $json['Event']['EventData']['URL'] = $data['video'];
    }

    return $json;
}

/**
 * Get post ID
 *
 */
function get_post_id($path)
{
    // Take apart URL path and build slug for each post type
    $parts = explode('/', $path);
    if ($parts[0] === 'blog' || (isset($parts[1]) && $parts[1] === 'forum')) {
        $slug = end($parts);
    } elseif ($parts[0] === 'campaign') {
        $slug = str_replace('campaign/', '', $path);
    } else {
        $slug = $path;
    }
    $post = get_page_by_path($slug, OBJECT, array('campaign', 'page', 'post', 'forum'));
    if ($post) {
        return $post->ID;
    }
}

/**
 * Get message queue URL based on environment
 *
 * @param string $env
 */
function get_eq_url($env)
{
    return IR_EQ;
}

/**
 * Form AJAX processing
 */
function process_event()
{
    $nonce = $_REQUEST['App_Nonce'];

    // Check to see if the submitted nonce matches with the
    // generated nonce we created earlier
    if (! wp_verify_nonce($nonce, 'app-nonce')) {
        // get_template_part('templates/404');
        wp_redirect('404');
        die();
    }

    // Encode event data into JSON
    $args = array(
    'browser'  => isset($_REQUEST['browser']) ? $_REQUEST['browser'] : null,
    'contactType'  => isset($_REQUEST['contactType']) ? $_REQUEST['contactType'] : null,
    'company'  => isset($_REQUEST['company']) ? $_REQUEST['company'] : null,
    'country'  => isset($_REQUEST['country']) ? $_REQUEST['country'] : null,
    'email'  => isset($_REQUEST['email']) ? $_REQUEST['email'] : null,
    'firstName'  => isset($_REQUEST['firstName']) ? $_REQUEST['firstName'] : null,
    'eventCode'  => isset($_REQUEST['eventCode']) ? $_REQUEST['eventCode'] : null,
    'eventTypeCode'  => isset($_REQUEST['eventTypeCode']) ? $_REQUEST['eventTypeCode'] : null,
    'lastName'  => isset($_REQUEST['lastName']) ? $_REQUEST['lastName'] : null,
    'locale'  => isset($_REQUEST['locale']) ? $_REQUEST['locale'] : null,
    'phone'  => isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null,
    'referrer'  => isset($_REQUEST['referrer']) ? $_REQUEST['referrer'] : null,
    'slug'  => isset($_REQUEST['slug']) ? $_REQUEST['slug'] : null,
    'userID'  => isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null,
    'video'  => isset($_REQUEST['video']) ? $_REQUEST['video'] : null,
  );

    $json = wp_json_encode(process_event_json($args));

    // Send data and process success / fail
    $response = wp_remote_post(
      IR_EQ,
      array(
      'method'      => 'POST',
      'timeout'     => 45,
      'redirection' => 5,
      'httpversion' => '1.0',
      'blocking'    => true,
      'headers'     => array(
        'Authorization' => 'Basic '.base64_encode('admin:admin'),
        'Content-Type' => 'application/json',
      ),
      'body'        => $json,
      'cookies'     => array(),
    )
  );

    // Check for a response, though the MQ is supposed to be always up...
    if ($response['response']['code'] == 200) {
        echo 'Big thanks from the EQ.'."\n";
    } elseif (is_wp_error($response)) {
        // Do something if error
        echo 'Error, the EQ has gremlins. ' . $response->get_error_message();
    } else {
        // Do something if failing
        echo 'Panic, the EQ is down.';
    }

    // Time to go home
    die;
}
add_action('wp_ajax_nopriv_process_event', __NAMESPACE__.'\\process_event');
add_action('wp_ajax_process_event', __NAMESPACE__.'\\process_event');

/**
 * Get host IP address
 */
function get_host_ip()
{
    // return gethostbyname(home_url());
    return IR_HOST_IP;
}
