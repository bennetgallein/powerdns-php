<?php

namespace Exonet\Powerdns\tests\functional;

use Exonet\Powerdns\Resources\TSIGKey as TSIGKeyResource;
use Exonet\Powerdns\TSIGKeyAlgorithms;

/**
 * @internal
 */
class TSIGKeysTest extends FunctionalTestCase {
    // public function testCreateTSIGKey(): void {
    //     $name = 'test-key-' . mt_rand(100, 10000);

    //     $manager  = $this->powerdns->tsigkeys();
    //     $resource = new TSIGKeyResource();

    //     $resource->setName($name);
    //     $resource->setAlgorithm(TSIGKeyAlgorithms::HMAC_SHA512);

    //     $key = $manager->create($resource);

    //     $this->assertNotEquals('', $key->getKey());

    //     // cleanup
    //     $manager->delete($key);
    // }

    // public function testCreateWithNonUrlFriendlyName(): void {
    //     $name = "this/is/not/aa-_412'aur\\asd-url-friendly-" . mt_rand(100, 10000);

    //     $manager  = $this->powerdns->tsigkeys();
    //     $resource = new TSIGKeyResource();

    //     $resource->setName($name);
    //     $resource->setAlgorithm(TSIGKeyAlgorithms::HMAC_SHA512);

    //     $key = $manager->create($resource);

    //     $this->assertNotEquals('', $key->getKey());

    //     // cleanup
    //     $manager->delete($key);
    // }

    // public function testDelete(): void {
    //     $name = 'test-key-' . mt_rand(100, 10000);

    //     $manager  = $this->powerdns->tsigkeys();
    //     $resource = new TSIGKeyResource();

    //     $resource->setName($name);
    //     $resource->setAlgorithm(TSIGKeyAlgorithms::HMAC_SHA512);

    //     $key = $manager->create($resource);

    //     // delete
    //     $res = $manager->delete($key);

    //     $this->assertTrue($res);
    // }

    public function testUpdate(): void {
        $name = 'test-key2-' . mt_rand(100, 10000) . microtime(true);

        $manager  = $this->powerdns->tsigkeys();
        $resource = new TSIGKeyResource();

        $resource->setName($name);
        $resource->setAlgorithm(TSIGKeyAlgorithms::HMAC_SHA512);

        $key = $manager->create($resource);
        fwrite(STDERR, print_r($key, TRUE));

        // // update
        $upd = new TSIGKeyResource([
            'id'        => $key->getId(),
            'algorithm' => TSIGKeyAlgorithms::HMAC_SHA256
        ]);
        fwrite(STDERR, print_r($upd, TRUE));

        $updatedKey = $manager->updateAlgorithm($upd);

        fwrite(STDERR, print_r($updatedKey, TRUE));


        // $this->assertNotEquals($updatedKey->getKey(), $key->getKey());

        // // delete
        // $res = $manager->delete($key);
    }
}
