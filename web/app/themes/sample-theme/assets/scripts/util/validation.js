const ValidationFullRules =
  {
    firstname: {
      identifier: 'firstName',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your first name',
        },
      ],
    },
    lastname: {
      identifier: 'lastName',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your last name',
        },
      ],
    },
    company: {
      identifier: 'company',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your company name',
        },
      ],
    },
    text: {
      identifier: 'text',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your query detail',
        },
      ],
    },
    jobtitle: {
      identifier: 'jobTitle',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your job title',
        },
      ],
    },
    position: {
      identifier: 'position',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your desired position',
        },
      ],
    },
    telephone: {
      identifier: 'phone',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your telephone number',
        },
      ],
    },
    email: {
      identifier: 'emailAddress',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your work email address',
        },
        {
          type: 'email',
          optional: true,
          prompt: 'Please enter a valid email address',
        },
      ],
    },
    website: {
      identifier: 'website',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your company website',
        },
      ],
    },
    interest: {
      identifier: 'interest',
      rules: [
        {
          type: 'empty',
          prompt: 'Please select an interest',
        },
      ],
    },
    country: {
      identifier: 'countryCode',
      rules: [
        {
          type: 'empty',
          prompt: 'Please select a country',
        },
      ],
    },
    checkbox: {
      identifier: 'checkbox',
      rules: [
        {
          type: 'checked',
          prompt: 'Please check the checkbox',
        },
      ],
    },
  };

const ValidationDevelopmentRules =
  {
    email: {
      identifier: 'emailAddress',
      rules: [
        {
          type: 'empty',
          prompt: 'Please enter your email address',
        },
      ],
    },
  };

// Only apply a single rule for local development
// This will run on a browser that supports ES6, via Buble currently,
// whilst Webpack is in watch mode
// (note this needs 'npm start' to be re-rerun)
let validation;
if (process.env.WP_ENV !== 'development') {
  validation = ValidationFullRules;
} else {
  validation = ValidationDevelopmentRules;
}

export {validation};
