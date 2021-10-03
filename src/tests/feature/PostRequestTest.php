<?php /** @noinspection ALL */

/** @noinspection ALL */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Exceptions\Handler;
use App\Exceptions\InvalidData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\DBHelper;

class PostRequestTest extends TestCase
{
	use DBHelper;
	use DatabaseTransactions;
	// use DatabaseMigrations;

	// delineate the range for valid eld event ids in the 'codes_events' table
	protected $config;

	public function setUp()
	{
        parent::setUp();
		$this->seedMockDatabase();
		$this->config = $this->getPostRequestData();
	}

	/**
	 * @test
	 */
	public function is_status_code_200()
	{
		putenv('PHPUNIT_TESTING=true');

		$contentArray = [
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $this->config['eldDevice']->id
			],
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $this->config['eldDevice']->id
			]
		];

		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		// var_dump($res);
		$this->seeStatusCode(200);
		// echo $res->exception;
		// $this->assertEquals(200, $res->status());
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_no_eld_device_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		$contentArray = [
			[
				'users_id' => $this->config['user']->id,
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'truck_stamp' => time(),
			],
			[
				'users_id' => $this->config['user']->id,
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'truck_stamp' => time(),
			]
		];

		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_no_user_id_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		$contentArray = [
			[
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'truck_stamp' => time(),
				'eld_devices_id' => $this->config['eldDevice']->id
			],
			[
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'truck_stamp' => time(),
				'eld_devices_id' => $this->config['eldDevice']->id
			]
		];
		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_no_eld_event_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		$contentArray = [
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_devices_id' => $this->config['eldDevice']->id
			],
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_devices_id' => $this->config['eldDevice']->id
			]
		];
		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_invalid_eld_event_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		// eld events correspond to `codes_events` in the DB. They should be integers from 1-28.
		$wrongEvent = 29;

		$contentArray = [
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => $wrongEvent,
				'eld_devices_id' => $this->config['eldDevice']->id
			],
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => $wrongEvent,
				'eld_devices_id' => $this->config['eldDevice']->id
			]
		];
		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_invalid_user_id_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		$wrongId = $this->config['user']->id + 1;

		$contentArray = [
			[
				'users_id' => $wrongId,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $this->config['eldDevice']->id
			],
			[
				'users_id' => $wrongId,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $this->config['eldDevice']->id
			]
		];
		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 * @test
	 */
	public function check_for_model_not_found_exception_when_invalid_eld_devices_id_sent(
	) {
		putenv('PHPUNIT_TESTING=true');

		$wrongId = $this->config['eldDevice']->id + 1;

		$contentArray = [
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $wrongId
			],
			[
				'users_id' => $this->config['user']->id,
				'truck_stamp' => time(),
				'eld_event' => rand($this->eventCodeMin, $this->eventCodeMax),
				'eld_devices_id' => $wrongId
			]
		];
		$res = $this->call(
			$this->config['method'],
			$this->config['url'],
			$this->config['params'],
			[],
			[],
			['Content-Type' => 'application/json'],
			json_encode($contentArray)
		);

		$this->seeStatusCode(500);
		putenv('PHPUNIT_TESTING=false');
	}
}
