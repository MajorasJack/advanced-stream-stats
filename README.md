## Advanced Streaming Stats

### Setup
* Clone the repository locally
* Run `composer install`
* Copy the environment example file and fill it out with the required Twitch & Braintree information:
```bash
BRAINTREE_MERCHANT_ID=
BRAINTREE_PUBLIC_KEY=
BRAINTREE_PRIVATE_KEY=
BRAINTREE_STARTER_PLAN_ID=
BRAINTREE_PRO_MONTHLY_PLAN_ID=
BRAINTREE_PRO_YEARLY_ID=
BRAINTREE_SANDBOX_CUSTOMER_ID=

TWITCH_CLIENT_ID=
TWITCH_CLIENT_SECRET=
TWITCH_REDIRECT_URI=
```

* Setup a local database to store authenticated users and references to the subscriptions
  * The database seeders will import your 3 braintree subscriptions from the following environment variables
```bash
BRAINTREE_STARTER_PLAN_ID=
BRAINTREE_PRO_MONTHLY_PLAN_ID=
BRAINTREE_PRO_YEARLY_ID= 
```

* Once setup is completed, run the testsuite to validate your changes, the testsuite is written using [PestPHP](https://pestphp.com/) which is a wrapper for PHPCS
* Ensure that NPM & Node.js is installed for the frontend
* Run `npm i` to install the dependencies
* Run `npm run dev` to run a development build of the assets
