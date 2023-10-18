<?php
namespace Gemvc\Trait\Table;
trait removeTrait
{
    /**
     * @ in case of success return 1
     * @Attention:  remove Object compleetly from Database and only work with property id
     */
    public function remove(): int|null
    {
        $table = $this->getTable();
        if(!$table)
        {
            $this->setError('table is not setted in function getTable');
            return null;
        }
        if(!isset($this->id))
        {
            $this->setError('property id does existed or not setted in object');
        }
        $query = "DELETE FROM {$table} WHERE id = :id";
        if (isset($this->id) && $this->id > 0) {
            return $this->deleteQuery($query, [':id' => $this->id]);
        }
        $this->setError('Object id is not set or it is less than 1');

        return null;
    }
}