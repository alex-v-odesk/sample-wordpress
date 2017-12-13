<?php
/**
 * AJAX functions to process form data
 */

namespace Ajax;

use Roots\Sage\App;

/**
 * Enqueue front end scripts to link JS to php processor
 *
 * 1. This needs match the url : App.ajaxurl & nonce in the ajax function call
 * 2. Generate a nonce with a unique ID so it can be checked later when an AJAX request is sent
 * 3. If needing to reuse (ie post multiple comments) then need to regenerate nonce
 */
add_action('wp_enqueue_scripts', function () {
    wp_localize_script(
        'main.js',
        'App',
        array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'App_Nonce' => wp_create_nonce('app-nonce')
    )
  );
}, 100);

/**
 * Form AJAX processing
 */
function process_form()
{
    $nonce = $_REQUEST['App_Nonce'];

    // Check to see if the submitted nonce matches with the
    // generated nonce we created earlier
    if (! wp_verify_nonce($nonce, 'app-nonce')) {
        // get_template_part('templates/404');
        wp_redirect('404');
        die();
    }

    // Process contact details
    $details = array(
      'company' => isset($_REQUEST['company']) ? $_REQUEST['company'] : null,
      'contactMessage' => isset($_REQUEST['contactMessage']) ? $_REQUEST['contactMessage'] : null,
      'countryCode' => isset($_REQUEST['countryCode']) ? $_REQUEST['countryCode'] : null,
      'emailAddress' => isset($_REQUEST['emailAddress']) ? $_REQUEST['emailAddress'] : null,
      'firstName' => isset($_REQUEST['firstName']) ? $_REQUEST['firstName'] : null,
      'interest' => isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null,
      'jobTitle' => isset($_REQUEST['jobTitle']) ? $_REQUEST['jobTitle'] : null,
      'lastName' => isset($_REQUEST['lastName']) ? $_REQUEST['lastName'] : null,
      'phone' => isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null,
      'website' => isset($_REQUEST['website']) ? $_REQUEST['website'] : null,
    );

    // Remove the contact type code
    $action = $_REQUEST['actionType'];
    unset($_REQUEST['actionType']);
    $type = $_REQUEST['contactTypeCode'];
    unset($_REQUEST['contactTypeCode']);

    // Select appropriate contact type code for general contact form
    if ($type == 'SELECT') :
    $type = get_contact_type($_REQUEST['interest']);
    endif;

    // Encode form data into JSON
    $json = wp_json_encode(process_form_json($action, $type, $details));
    // var_dump($json);

    // Send data and process success / fail
    $response = wp_remote_post(
      IR_FQ,
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
      'cookies'     => array()
      )
  );

    // Check for a response, though the MQ is supposed to be always up...
    if ($response['response']['code'] == 200) {
        echo 'Big thanks from the FQ.'."\n";
    } elseif (is_wp_error($response)) {
        // Do something if error
        echo 'Error, the FQ has gremlins: ' . $response->get_error_message();
    } else {
        // Do something if failing
        echo 'Panic, the FQ is down.';
    }

    // Time to go home
    die;
}
add_action('wp_ajax_nopriv_process_form', __NAMESPACE__.'\\process_form');
add_action('wp_ajax_process_form', __NAMESPACE__.'\\process_form');

/**
 * Get form queue URL based on environment
 *
 * @param string $env
 */
function get_fq_url($env)
{
    return IR_FQ;
}

/**
 * JSON for form
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
function process_form_json($action, $type, $details)
{
    return array(
    'action' => $action,
    'requestUUID' => substr(md5(rand()), 0, 32),
    'contactTypeCode' => $type,
    'GMTContactDate' => gmdate('Y-m-d'),
    'GMTContactTime' => time() - strtotime('today'),
    'GMTContactTimestamp' => gmdate('Y-m-d G:i:s P'),
    'requestOrigin' => IR_ORIGIN,
    'contactDetails' => $details,
    'requestorIpAddress' => null,
    'requestorLocale' => IR_LOCALE,
    'requestorSessionId' => substr(md5(rand()), 0, 32),
    'requestorUserId' => get_current_user_id(),
  );
}

/**
 *
 *
 */
function get_contact_type($interest)
{
    if ($interest == 'Support') :
    return 'SUPPORT'; elseif ($interest == 'Career') :
    return 'CAREERS'; elseif ($interest == 'Services') :
    return 'SERVICES'; elseif ($interest == 'Training') :
    return 'SERVICES'; elseif ($interest == 'General Inquiry') :
    return 'OTHER'; elseif ($interest == 'Other') :
    return 'OTHER'; else :
    return null;
    endif;
}

/**
 * Encode email and Munchkin API key
 *
 */
function get_hash()
{
    $nonce = $_REQUEST['App_Nonce'];

    // Check to see if the submitted nonce matches with the
    // generated nonce we created earlier
    if (! wp_verify_nonce($nonce, 'app-nonce')) {
        // get_template_part('templates/404');
        wp_redirect('404');
        die();
    }

    $email = $_REQUEST['email'];
    $key = IR_MUNCHKIN_API;
    echo hash('sha1', $key . $email);

    // Time to go home
    die;
}
add_action('wp_ajax_nopriv_get_hash', __NAMESPACE__.'\\get_hash');
add_action('wp_ajax_get_hash', __NAMESPACE__.'\\get_hash');
