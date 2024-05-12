<?php

namespace Exonet\Powerdns;

use Exonet\Powerdns\Resources\TSIGKey as TSIGKeyResource;
use Exonet\Powerdns\Resources\TSIGKeySet;
use Exonet\Powerdns\Transformers\TSIGKeyCreateTransformer;
use Exonet\Powerdns\Transformers\TSIGKeyTransformer;
use Exonet\Powerdns\Transformers\TSIGKeyUpdateAlgorithmTransformer;

class TSIGKey {

    /**
     * get a new instance of the tsig interface
     *
     * @param ConnectorInterface $connector
     */
    public function __construct(
        private ConnectorInterface $connector) {
    }

    /**
     * Get all tsigkeys on the server.
     *
     * @return TSIGKeySet The meta data set.
     */
    public function list(): TSIGKeySet {
        $items = $this->connector->get('tsigkeys');

        $resultSet = new TSIGKeySet();
        foreach ($items as $item) {
            $resultSet->addResource(new TSIGKeyResource($item));
        }

        return $resultSet;
    }

    /**
     * Get a single tsigkey.
     *
     * @param string $id the id
     *
     * @return TSIGKeyResource The meta data set.
     */
    public function get(string $id): TSIGKeyResource {
        $item = $this->connector->get('tsigkeys/' . $id);

        return new TSIGKeyResource($item);
    }

    /**
     * Creat a new TSIG Key.
     *
     * @param array|string $data The data.
     *
     * @return TSIGKeyResource The created key data.
     */
    public function create(TSIGKeyResource $data): TSIGKeyResource {
        $response = $this->connector->post('tsigkeys', new TSIGKeyCreateTransformer($data));

        return new TSIGKeyResource($response);
    }

    /**
     * Update an existing TSIGKey and reset the algorithm
     *
     * @param TSIGKeyResource $key The key data item to update.
     *
     * @return TSIGKeyResource the updated key resource.
     */
    public function updateAlgorithm(TSIGKeyResource $key): TSIGKeyResource {
        $response = $this->connector->put('tsigkeys/' . $key->getId(), new TSIGKeyUpdateAlgorithmTransformer($key));
        return new TSIGKeyResource($response);
    }

    /**
     * Delete an existing tsigkey item.
     *
     * @param TSIGKeyResource $key The tsigkey data item to delete.
     *
     * @return bool True if the delete was successful.
     */
    public function delete(TSIGKeyResource $key): bool {
        $response = $this->connector->delete('tsigkeys/' . $key->getId());

        // If the response is empty, everything is fine.
        return empty($response);
    }
}
