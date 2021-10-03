<?php

use Redrye\LaravelWebSocketsCrud\app\Broadcasting\Login;
use App\Events\loginEvent;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'https://smartgunite.com';

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__ . '/../bootstrap/User.php.php';

		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}


	public function assertEventIsBroadcasted($eventClassName, $channel = '')
	{
		$date = Carbon::now()->format('Y-m-d');
		$logfileFullpath = storage_path("logs/laravel-{$date}.log");
		$logfile = explode("\n", file_get_contents($logfileFullpath));
		$indexOfLoggedEvent = $this->getIndexOfLoggedEvent($logfile);

		if ($indexOfLoggedEvent) {
			$supposedLastEventLogged = $logfile[$indexOfLoggedEvent];
			$this->assertContains('Broadcasting [', $supposedLastEventLogged, "No broadcast were found.\n");

			$this->assertContains(
				'Broadcasting [' . $eventClassName . ']',
				$supposedLastEventLogged,
				"A broadcast was found, but not for the classname '" . $eventClassName . "'.\n"
			);

			if ($channel != '') {
				$this->assertContains(
					'Broadcasting [' . $eventClassName . '] on channels [' . $channel . ']',
					$supposedLastEventLogged,
					'The expected broadcast (' . $eventClassName . ") event was found, but not on the expected channel '" . $channel . "'.\n"
				);
			}
		} else {
			$this->fail("No informations found in the file log '" . $logfileFullpath . "'.");
		}
	}

	private function getIndexOfLoggedEvent(array $logfile)
	{
		for ($i = count($logfile) - 1; $i >= 0; $i--) {
			if (strpos($logfile[$i], 'local.INFO: Broadcasting') !== false) {
				return $i;
			}
		}
		return false;
	}


	/**
	 * @test
	 */
	public function notifications_are_broadcasted()
	{
		$login = factory(Login::class)->create();
		broadcast(new loginEvent($login));
		$this->assertEventIsBroadcasted(
			login::class,
			'private-notification.' . $login->id
		);
	}
}
