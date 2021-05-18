<?php

namespace AsyncAws\Kinesis\Tests\Unit;

use AsyncAws\Core\Credentials\NullProvider;
use AsyncAws\Core\Test\TestCase;
use AsyncAws\Kinesis\Input\PutRecordInput;
use AsyncAws\Kinesis\Input\PutRecordsInput;
use AsyncAws\Kinesis\Input\RegisterStreamConsumerInput;
use AsyncAws\Kinesis\Result\PutRecordOutput;
use AsyncAws\Kinesis\Result\PutRecordsOutput;
use AsyncAws\Kinesis\Result\RegisterStreamConsumerOutput;
use AsyncAws\Kinesis\ValueObject\PutRecordsRequestEntry;
use Symfony\Component\HttpClient\MockHttpClient;

class KinesisClientTest extends TestCase
{
    public function testPutRecord(): void
    {
        $client = new KinesisClient([], new NullProvider(), new MockHttpClient());

        $input = new PutRecordInput([
            'StreamName' => 'change me',
            'Data' => 'change me',
            'PartitionKey' => 'change me',

        ]);
        $result = $client->PutRecord($input);

        self::assertInstanceOf(PutRecordOutput::class, $result);
        self::assertFalse($result->info()['resolved']);
    }

    public function testPutRecords(): void
    {
        $client = new KinesisClient([], new NullProvider(), new MockHttpClient());

        $input = new PutRecordsInput([
            'Records' => [new PutRecordsRequestEntry([
                'Data' => 'change me',

                'PartitionKey' => 'change me',
            ])],
            'StreamName' => 'change me',
        ]);
        $result = $client->PutRecords($input);

        self::assertInstanceOf(PutRecordsOutput::class, $result);
        self::assertFalse($result->info()['resolved']);
    }

    public function testRegisterStreamConsumer(): void
    {
        $client = new KinesisClient([], new NullProvider(), new MockHttpClient());

        $input = new RegisterStreamConsumerInput([
            'StreamARN' => 'change me',
            'ConsumerName' => 'change me',
        ]);
        $result = $client->RegisterStreamConsumer($input);

        self::assertInstanceOf(RegisterStreamConsumerOutput::class, $result);
        self::assertFalse($result->info()['resolved']);
    }
}
