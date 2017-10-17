<?php // Контролер продуктов(преподов)
namespace controllers;

class View
{
    private $data = [];

    private $render = FALSE;

    public function __construct($template)
    {
        try {
            $file = 'views/' . strtolower($template) . '.php';

            if (file_exists($file)) {
                $this->render = $file;
            } else {
                throw new \Exception('Template ' . $template . ' not found!' . $file);
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function setData(array $data)
    {
        foreach ($data as $key => $value){

            $this->data[$key] = $value;
        }
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}
?>