<?php

namespace AsyncAws\Kinesis\Tests\Integration;

use AsyncAws\Core\Credentials\NullProvider;
use AsyncAws\Core\Test\TestCase;
use AsyncAws\Kinesis\Input\PutRecordInput;
use AsyncAws\Kinesis\Input\PutRecordsInput;
use AsyncAws\Kinesis\Input\RegisterStreamConsumerInput;
use AsyncAws\Kinesis\KinesisClient;
use AsyncAws\Kinesis\ValueObject\PutRecordsRequestEntry;

class KinesisClientTest extends TestCase
{
    public function testPutRecord(): void
    {
        $client = $this->getClient();

        $input = new PutRecordInput([
            'StreamName' => 'change me',
            'Data' => 'change me',
            'PartitionKey' => 'change me',
            'ExplicitHashKey' => 'change me',
            'SequenceNumberForOrdering' => 'change me',
        ]);
        $result = $client->PutRecord($input);

        $result->resolve();

        self::assertSame('changeIt', $result->getShardId());
        self::assertSame('changeIt', $result->getSequenceNumber());
        self::assertSame('changeIt', $result->getEncryptionType());
    }

    public function testPutRecords(): void
    {
        $client = $this->getClient();

        $input = new PutRecordsInput([
            'Records' => [new PutRecordsRequestEntry([
                'Data' => 'change me',
                'ExplicitHashKey' => 'change me',
                'PartitionKey' => 'change me',
            ])],
            'StreamName' => 'change me',
        ]);
        $result = $client->PutRecords($input);

        $result->resolve();

        self::assertSame(1337, $result->getFailedRecordCount());
        // self::assertTODO(expected, $result->getRecords());
        self::assertSame('changeIt', $result->getEncryptionType());
    }

    public function testRegisterStreamConsumer(): void
    {
        $client = $this->getClient();

        $input = new RegisterStreamConsumerInput([
            'StreamARN' => 'change me',
            'ConsumerName' => 'change me',
        ]);
        $result = $client->RegisterStreamConsumer($input);

        $result->resolve();

        // self::assertTODO(expected, $result->getConsumer());
    }

    private function getClient(): KinesisClient
    {
        self::fail('Not implemented');

        return new KinesisClient([
            'endpoint' => 'http://localhost',
        ], new NullProvider());
    }
}
