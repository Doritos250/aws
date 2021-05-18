<?php

namespace AsyncAws\Kinesis\Enum;

/**
 * The encryption type used on the records. This parameter can be one of the following values:.
 *
 * - `NONE`: Do not encrypt the records.
 * - `KMS`: Use server-side encryption on the records using a customer-managed AWS KMS key.
 */
final class EncryptionType
{
    public const KMS = 'KMS';
    public const NONE = 'NONE';

    public static function exists(string $value): bool
    {
        return isset([
            self::KMS => true,
            self::NONE => true,
        ][$value]);
    }
}
