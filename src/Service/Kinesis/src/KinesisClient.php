<?php

namespace AsyncAws\Kinesis;

use AsyncAws\Core\AbstractApi;
use AsyncAws\Core\AwsError\AwsErrorFactoryInterface;
use AsyncAws\Core\AwsError\JsonRpcAwsErrorFactory;
use AsyncAws\Core\Configuration;
use AsyncAws\Core\RequestContext;
use AsyncAws\Kinesis\Exception\InvalidArgumentException;
use AsyncAws\Kinesis\Exception\KMSAccessDeniedException;
use AsyncAws\Kinesis\Exception\KMSDisabledException;
use AsyncAws\Kinesis\Exception\KMSInvalidStateException;
use AsyncAws\Kinesis\Exception\KMSNotFoundException;
use AsyncAws\Kinesis\Exception\KMSOptInRequiredException;
use AsyncAws\Kinesis\Exception\KMSThrottlingException;
use AsyncAws\Kinesis\Exception\LimitExceededException;
use AsyncAws\Kinesis\Exception\ProvisionedThroughputExceededException;
use AsyncAws\Kinesis\Exception\ResourceInUseException;
use AsyncAws\Kinesis\Exception\ResourceNotFoundException;
use AsyncAws\Kinesis\Input\PutRecordInput;
use AsyncAws\Kinesis\Input\PutRecordsInput;
use AsyncAws\Kinesis\Input\RegisterStreamConsumerInput;
use AsyncAws\Kinesis\Result\PutRecordOutput;
use AsyncAws\Kinesis\Result\PutRecordsOutput;
use AsyncAws\Kinesis\Result\RegisterStreamConsumerOutput;
use AsyncAws\Kinesis\ValueObject\PutRecordsRequestEntry;

class KinesisClient extends AbstractApi
{
    /**
     * Writes a single data record into an Amazon Kinesis data stream. Call `PutRecord` to send data into the stream for
     * real-time ingestion and subsequent processing, one record at a time. Each shard can support writes up to 1,000
     * records per second, up to a maximum data write total of 1 MB per second.
     *
     * @see https://docs.aws.amazon.com/kinesis/latest/APIReference/Welcome.html/API_PutRecord.html
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-kinesis-2013-12-02.html#putrecord
     *
     * @param array{
     *   StreamName: string,
     *   Data: string,
     *   PartitionKey: string,
     *   ExplicitHashKey?: string,
     *   SequenceNumberForOrdering?: string,
     *   @region?: string,
     * }|PutRecordInput $input
     *
     * @throws ResourceNotFoundException
     * @throws InvalidArgumentException
     * @throws ProvisionedThroughputExceededException
     * @throws KMSDisabledException
     * @throws KMSInvalidStateException
     * @throws KMSAccessDeniedException
     * @throws KMSNotFoundException
     * @throws KMSOptInRequiredException
     * @throws KMSThrottlingException
     */
    public function putRecord($input): PutRecordOutput
    {
        $input = PutRecordInput::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'PutRecord', 'region' => $input->getRegion(), 'exceptionMapping' => [
            'ResourceNotFoundException' => ResourceNotFoundException::class,
            'InvalidArgumentException' => InvalidArgumentException::class,
            'ProvisionedThroughputExceededException' => ProvisionedThroughputExceededException::class,
            'KMSDisabledException' => KMSDisabledException::class,
            'KMSInvalidStateException' => KMSInvalidStateException::class,
            'KMSAccessDeniedException' => KMSAccessDeniedException::class,
            'KMSNotFoundException' => KMSNotFoundException::class,
            'KMSOptInRequired' => KMSOptInRequiredException::class,
            'KMSThrottlingException' => KMSThrottlingException::class,
        ]]));

        return new PutRecordOutput($response);
    }

    /**
     * Writes multiple data records into a Kinesis data stream in a single call (also referred to as a `PutRecords`
     * request). Use this operation to send data into the stream for data ingestion and processing.
     *
     * @see https://docs.aws.amazon.com/kinesis/latest/APIReference/Welcome.html/API_PutRecords.html
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-kinesis-2013-12-02.html#putrecords
     *
     * @param array{
     *   Records: PutRecordsRequestEntry[],
     *   StreamName: string,
     *   @region?: string,
     * }|PutRecordsInput $input
     *
     * @throws ResourceNotFoundException
     * @throws InvalidArgumentException
     * @throws ProvisionedThroughputExceededException
     * @throws KMSDisabledException
     * @throws KMSInvalidStateException
     * @throws KMSAccessDeniedException
     * @throws KMSNotFoundException
     * @throws KMSOptInRequiredException
     * @throws KMSThrottlingException
     */
    public function putRecords($input): PutRecordsOutput
    {
        $input = PutRecordsInput::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'PutRecords', 'region' => $input->getRegion(), 'exceptionMapping' => [
            'ResourceNotFoundException' => ResourceNotFoundException::class,
            'InvalidArgumentException' => InvalidArgumentException::class,
            'ProvisionedThroughputExceededException' => ProvisionedThroughputExceededException::class,
            'KMSDisabledException' => KMSDisabledException::class,
            'KMSInvalidStateException' => KMSInvalidStateException::class,
            'KMSAccessDeniedException' => KMSAccessDeniedException::class,
            'KMSNotFoundException' => KMSNotFoundException::class,
            'KMSOptInRequired' => KMSOptInRequiredException::class,
            'KMSThrottlingException' => KMSThrottlingException::class,
        ]]));

        return new PutRecordsOutput($response);
    }

    /**
     * Registers a consumer with a Kinesis data stream. When you use this operation, the consumer you register can read data
     * from the stream at a rate of up to 2 MiB per second. This rate is unaffected by the total number of consumers that
     * read from the same stream.
     *
     * @see https://docs.aws.amazon.com/kinesis/latest/APIReference/Welcome.html/API_RegisterStreamConsumer.html
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-kinesis-2013-12-02.html#registerstreamconsumer
     *
     * @param array{
     *   StreamARN: string,
     *   ConsumerName: string,
     *   @region?: string,
     * }|RegisterStreamConsumerInput $input
     *
     * @throws InvalidArgumentException
     * @throws LimitExceededException
     * @throws ResourceInUseException
     * @throws ResourceNotFoundException
     */
    public function registerStreamConsumer($input): RegisterStreamConsumerOutput
    {
        $input = RegisterStreamConsumerInput::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'RegisterStreamConsumer', 'region' => $input->getRegion(), 'exceptionMapping' => [
            'InvalidArgumentException' => InvalidArgumentException::class,
            'LimitExceededException' => LimitExceededException::class,
            'ResourceInUseException' => ResourceInUseException::class,
            'ResourceNotFoundException' => ResourceNotFoundException::class,
        ]]));

        return new RegisterStreamConsumerOutput($response);
    }

    protected function getAwsErrorFactory(): AwsErrorFactoryInterface
    {
        return new JsonRpcAwsErrorFactory();
    }

    protected function getEndpointMetadata(?string $region): array
    {
        if (null === $region) {
            $region = Configuration::DEFAULT_REGION;
        }

        switch ($region) {
            case 'cn-north-1':
            case 'cn-northwest-1':
                return [
                    'endpoint' => "https://kinesis.$region.amazonaws.com.cn",
                    'signRegion' => $region,
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'us-iso-east-1':
                return [
                    'endpoint' => "https://kinesis.$region.c2s.ic.gov",
                    'signRegion' => $region,
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'us-isob-east-1':
                return [
                    'endpoint' => "https://kinesis.$region.sc2s.sgov.gov",
                    'signRegion' => $region,
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'fips-us-east-1':
                return [
                    'endpoint' => 'https://kinesis-fips.us-east-1.amazonaws.com',
                    'signRegion' => 'us-east-1',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'fips-us-east-2':
                return [
                    'endpoint' => 'https://kinesis-fips.us-east-2.amazonaws.com',
                    'signRegion' => 'us-east-2',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'fips-us-west-1':
                return [
                    'endpoint' => 'https://kinesis-fips.us-west-1.amazonaws.com',
                    'signRegion' => 'us-west-1',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'fips-us-west-2':
                return [
                    'endpoint' => 'https://kinesis-fips.us-west-2.amazonaws.com',
                    'signRegion' => 'us-west-2',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'us-gov-east-1':
                return [
                    'endpoint' => 'https://kinesis.us-gov-east-1.amazonaws.com',
                    'signRegion' => 'us-gov-east-1',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
            case 'us-gov-west-1':
                return [
                    'endpoint' => 'https://kinesis.us-gov-west-1.amazonaws.com',
                    'signRegion' => 'us-gov-west-1',
                    'signService' => 'kinesis',
                    'signVersions' => ['v4'],
                ];
        }

        return [
            'endpoint' => "https://kinesis.$region.amazonaws.com",
            'signRegion' => $region,
            'signService' => 'kinesis',
            'signVersions' => ['v4'],
        ];
    }
}
