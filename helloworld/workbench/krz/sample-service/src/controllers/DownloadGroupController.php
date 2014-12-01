<?php namespace Krz\SampleService;

use App;
use Log;
use Queue;
use Statsd;

class DownloadGroupController {

	/**
	 * Download group from id in job.
	 *
	 * @return mixed
	 */
	public function fire($job, $data)
	{
		App::make('Trace')->populateTrace($data['traceId'], $data['spanId']);

		$groupId = $data['groupId'];
		Log::info('Downloading groupId ', [ 'groupId' => $groupId ]);

		$jobClass = 'Krz\SampleService\ProcessDownloadedGroupController';
		$jobQueue = str_replace('\\', '.', explode('\\', $jobClass, 2)[1]);

		$jobParams = [
			'groupId' => $groupId,
			'traceId' => App::make('Trace')->traceId,
			'spanId' => App::make('Trace')->spanId,
		];
  	Queue::push($jobClass, $jobParams, $jobQueue);

		$job->delete();

		Statsd::increment('SampleService.DownloadedGroups');
	}

}
