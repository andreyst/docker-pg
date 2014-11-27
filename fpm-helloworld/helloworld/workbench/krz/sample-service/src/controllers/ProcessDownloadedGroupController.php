<?php namespace Krz\SampleService;

use App;
use Log;
use Queue;

class ProcessDownloadedGroupController {

  /**
   * Diff previous group with current data and add results to log.
   *
   * @return mixed
   */
  public function fire($job, $data)
  {
    App::make('Trace')->populateTrace($data['traceId'], $data['spanId']);

    $groupId = $data['groupId'];
    Log::info('Processing downloaded group', [ 'groupId' => $groupId ]);

    $jobClass = 'Krz\SampleService\DownloadGroupController';
    $jobQueue = str_replace('\\', '.', explode('\\', $jobClass, 2)[1]);

    $newTrace = App::make('Trace')->generateNewTrace(true);
    Log::info('Generated new trace', [
      'newTraceId' => $newTrace['traceId'],
      'newSpanId' => $newTrace['spanId'],
    ]);
    $jobParams = [
      'groupId' => $groupId,
      'traceId' => $newTrace['traceId'],
      'spanId' => $newTrace['spanId'],
    ];
    Queue::push($jobClass, $jobParams, $jobQueue);

    $job->delete();
  }

}
