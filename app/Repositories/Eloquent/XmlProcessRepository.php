<?php

namespace App\Repositories\Eloquent;

use App\Jobs\XmlProcessJob;
use App\Models\People;
use App\Repositories\Contracts\XmlProcessRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\XmlProcess;
use SimpleXMLElement;

class XmlProcessRepository implements XmlProcessRepositoryInterface
{
    /**
     * XmlProcess model
     *
     * @var XmlProcess
     */
    protected $xmlProcess;

    /**
     * XmlProcess repository constructor
     *
     * @param XmlProcess $xmlProcess
     */
    public function __construct(XmlProcess $xmlProcess)
    {
        $this->xmlProcess = $xmlProcess;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->xmlProcess)
            ->allowedFilters($this->xmlProcess->getFillable())
            ->allowedFields($this->xmlProcess->getFillable())
            ->allowedSorts($this->xmlProcess->getFillable())
            ->allowedIncludes($this->xmlProcess->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->xmlProcess)
            ->allowedFields($this->xmlProcess->getFillable())
            ->allowedIncludes($this->xmlProcess->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        try {
            $xml = simplexml_load_string(storage_get($data['file']));

            switch ($data['table']) {
                case 'people':
                    return $this->processXmlPerson($xml);
                    break;
                case 'shiporders':
                    return $this->processXmlShiporder($xml);
                    break;
            }
        } catch (\Throwable $th) {
            return ($th);
        }

        // $xmlProcess = new $this->xmlProcess;
        // $xmlProcess->fill($data);
        // $xmlProcess->save();



        // return $xmlProcess;
    }

    private function processXmlPerson($xml)
    {
        foreach ($xml->person as $value) {
            return ($value->personname);
            $person = People::create([
                'person_id' => $value->personid,
                'name' => $value->personname,
            ]);
        }

        return $person;
    }

    private function processXmlShiporder($xml)
    {
        return ($xml);
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $xmlProcess = $this->xmlProcess->findOrFail($id);
        $xmlProcess->fill($data);
        $xmlProcess->save();

        return $xmlProcess;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->xmlProcess->findOrFail($id)->delete();
    }
}
