<?php

declare(strict_types=1);

class SupplierController extends Controller
{

    public function __construct()
    {
        Auth::access();
        $this->loadModels(['supplier']);
    }

    public function index()
    {

        $suppliers = $this->model('supplier')->readAll();
        $pagination = $this->model('supplier')->paginations();

        include View::render('supplier');
    }

    public function new()
    {

        $countries = $this->model('supplier')->getCountries();

        if ($this->submitForm()) {

            $validator = $this->model('supplier')->formValidate('all');

            if ($validator['valid']) {

                $schema = $validator['schema'];

                $this->model('supplier')->setTradename($schema['tradename']);
                $this->model('supplier')->setBusinessName($schema['business_name']);
                $this->model('supplier')->setCif($schema['cif']);
                $this->model('supplier')->setIdCountry($schema['id_country']);
                $this->model('supplier')->setProvince($schema['province']);
                $this->model('supplier')->setLocality($schema['locality']);
                $this->model('supplier')->setPostalCode($schema['postal_code']);
                $this->model('supplier')->setAddress($schema['address']);
                $this->model('supplier')->setPhone($schema['phone']);
                $this->model('supplier')->setEmail($schema['email']);

                $this->setResponseMessage($this->model('supplier')->create());
            } else {
                $this->setResponseMessage($validator['errors']);
            }
        }

        include View::render('supplier', 'new');
    }

    public function update()
    {

        $this->model('supplier')->setId($_GET['id']);

        $supplier = $this->model('supplier')->read();
        $countries = $this->model('supplier')->getCountries();
        $country = Utils::nameDatalist($countries, $supplier['_id_country'], 'name');

        if ($this->submitForm()) {

            $validator = $this->model('supplier')->formValidate('all');

            if ($validator['valid']) {

                $schema = $validator['schema'];

                $this->model('supplier')->setTradename($schema['tradename']);
                $this->model('supplier')->setBusinessName($schema['business_name']);
                $this->model('supplier')->setCif($schema['cif']);
                $this->model('supplier')->setIdCountry($schema['id_country']);
                $this->model('supplier')->setProvince($schema['province']);
                $this->model('supplier')->setLocality($schema['locality']);
                $this->model('supplier')->setPostalCode($schema['postal_code']);
                $this->model('supplier')->setAddress($schema['address']);
                $this->model('supplier')->setPhone($schema['phone']);
                $this->model('supplier')->setEmail($schema['email']);

                $this->setResponseMessage($this->model('supplier')->update());
            } else {
                $this->setResponseMessage($validator['errors']);
            }
        }

        include View::render('supplier', 'update');
    }
}
