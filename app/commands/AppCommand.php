<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppCommand extends Command {
	/**
	 * The console command name.
	 *
	 * @var	string
	 */
	protected $name = 'app:install';
	/**
	 * The console command description.
	 *
	 * @var	string
	 */
	protected $description = '';
	/**
	 * Holds the user information.
	 *
	 * @var array
	 */
	protected $userData = array(
		'first_name' => null,
		'last_name'  => null,
		'email'      => null,
		'password'   => null
	);
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire() {
		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Step: 1');
		$this->comment('');
		$this->info('    Please follow the following');
		$this->info('    instructions to create your');
		$this->info('    default user.');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');
		// Let's ask the user some questions, shall we?
		$this->askUserFirstName();
		$this->askUserLastName();
		$this->askUserEmail();
		$this->askUserPassword();
		$this->comment('');
		$this->comment('');
		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Step: 2');
		$this->comment('');
		$this->info('    Preparing your Application');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');
		// Generate the Application Encryption key
		//$this->call('key:generate');
		// Run the Migrations
		$this->call('migrate');
		// Run the Sentry Migrations
		$this->call('migrate', array('--package' => 'cartalyst/sentry'));
		// Create the default user and default groups.
		$this->sentryRunner();
		// Seed the tables with dummy data
		$this->call('db:seed');
	}
	/**
	 * Asks the user for the first name.
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserFirstName() {

		$rule = array('first_name' => 'required');
		do {
			// Ask the user to input the first name.
			//
			$first_name = $this->ask('Please enter your first name: ');
			// Check if the first name is valid.
			//
			$validator = Validator::make(array('first_name' => $first_name), $rule);
			if ($validator->fails()) {
				// Return an error message.
				//
				//$this->error('Your first name is invalid. Please try again.');
				$messages = $validator->messages();
				$this->error($messages->first('first_name').' Please try again.');
			} else {
				// Store the user first name.
				//
				$this->userData['first_name'] = $first_name;
			}
			
		} while( $this->userData['first_name'] == null);
	}
	/**
	 * Asks the user for the last name.
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserLastName() {
		
		$rule = array('last_name' => 'required');
		do {
			// Ask the user to input the last name.
			//
			$last_name = $this->ask('Please enter your last name: ');
			// Check if the last name is valid.
			//
			$validator = Validator::make(array('last_name' => $last_name), $rule);
			if ($validator->fails()) {
				// Return an error message.
				//
				//$this->error('Your last name is invalid. Please try again.');
				$messages = $validator->messages();
				$this->error($messages->first('last_name').' Please try again.');
			} else {
				// Store the user last name.
				//
				$this->userData['last_name'] = $last_name;
			}
		}  while( $this->userData['last_name'] == null);
	}
	/**
	 * Asks the user for the user email address.
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserEmail() {
		
		$rule = array('email' => 'required|email|unique:users');
		do {
			// Ask the user to input the email address.
			//
			$email = $this->ask('Please enter your user email: ');
			// Check if email is valid.
			//
			$validator = Validator::make(array('email' => $email), $rule);
			if ($validator->fails()) {
				// Return an error message.
				//
				$messages = $validator->messages();
				$this->error($messages->first('email').' Please try again.');
			} else {
				// Store the user email.
				//
				$this->userData['email'] = $email;
			}
		}  while( $this->userData['email'] == null);
	}
	/**
	 * Asks the user for the user password.
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserPassword() {

		$rule = array('password' => 'required|min:6');
		do {
			// Ask the user to input the user password.
			//
			$password = $this->ask('Please enter your user password: ');
			// Check if password is valid.
			//
			$validator = Validator::make(array('password' => $password), $rule);
			if ($validator->fails()) {
				// Return an error message.
				//
				$messages = $validator->messages();
				$this->error($messages->first('password').' Please try again.');
			} else {
				// Store the user password.
				//
				$this->userData['password'] = $password;
			}
		}  while( $this->userData['password'] == null);
	}
	/**
	 * Runs all the necessary Sentry commands.
	 *
	 * @return void
	 */
	protected function sentryRunner() {
		// Create the default groups.
		//
		$this->sentryCreateDefaultGroups();
		// Create the user.
		//
		$this->sentryCreateUser();
	}
	/**
	 * Creates the default groups.
	 *
	 * @return void
	 */
	protected function sentryCreateDefaultGroups() {
		try {
			// Create the admin group.
			//
			$group = Sentry::getGroupProvider()->create(array(
				'name'        => 'Admin',
				'permissions' => array(
					'view' => 1,
					'add' => 1,
					'edit' => 1,
					'delete' => 1
				)
			));
			// Show the success message.
			//
			$this->comment('');
			$this->info('Admin group created successfully.');

			$group = Sentry::getGroupProvider()->create(array(
				'name'        => 'User',
				'permissions' => array(
					'view' => 1,
					'add' => 0,
					'edit' => 1,
					'delete' => 0
				)
			));
			// Show the success message.
			//
			$this->comment('');
			$this->info('User group created successfully.');
		
		} catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
			$this->error('Group already exists.');
		}
	}
	/**
	 * Create the user and associates the admin group to that user.
	 *
	 * @return void
	 */
	protected function sentryCreateUser() {
		// Prepare the user data array.
		//
		$data = array_merge($this->userData, array(
			'activated'   => 1
		));
		// Create the user.
		//
		$user = Sentry::getUserProvider()->create($data);
		// Associate the Admin group to this user.
		//
		//$group = Sentry::getGroupProvider()->findById(1);
		$group = Sentry::getGroupProvider()->findByName('Admin');
		$user->addGroup($group);
		// Show the success message.
		//
		$this->comment('');
		$this->info('Your user was created successfully.');
		$this->comment('');
	}
}