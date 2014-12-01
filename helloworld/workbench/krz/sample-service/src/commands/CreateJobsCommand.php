<?php namespace Krz\SampleService;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App;
use Log;
use Queue;

class CreateJobsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sampleservice:createjobs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add jobs for all groups to queue';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		App::make('Trace')->generateNewTrace();

		$jobClass = 'Krz\SampleService\DownloadGroupController';
		$jobQueue = str_replace('\\', '.', explode('\\', $jobClass, 2)[1]);

		$groups = [
			4145, // xs
			129087, // xs
			428999, // xs
			2256, // s
			131, // s
			13151 // s
		];

		foreach($groups as $groupId) {
			Log::info('Pushed groupId ' . $groupId);
			$jobParams = [
				'groupId' => $groupId,
				'traceId' => App::make('Trace')->traceId,
				'spanId' => App::make('Trace')->spanId,
			];
			Queue::push($jobClass, $jobParams, $jobQueue);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
