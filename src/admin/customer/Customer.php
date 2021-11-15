<?php

namespace demo\admin\customer;

use demo\admin\order\Order;
use demo\AdminAutoMaker;
use koolreport\dashboard\admin\relations\HasMany;
use koolreport\dashboard\admin\Resource;
use koolreport\dashboard\fields\Currency;
use koolreport\dashboard\fields\ID;
use koolreport\dashboard\fields\Text;
use koolreport\dashboard\validators\NumericValidator;
use koolreport\dashboard\validators\RequiredFieldValidator;

class Customer extends Resource
{
    protected function onCreated()
    {
        $this->manageTable("customers")->inSource(AdminAutoMaker::class);

        //Allow searchBox
        $this->listScreen()->searchBox()
        ->enabled(true);

        $this->listScreen()->adminTable()
            ->tableStriped(true);
    }

    protected function relations()
    {
        return [
            HasMany::resource(Order::class)->link(["customerNumber"=>"customerNumber"])->title("Orders")
        ];
    }

    protected function filters()
    {
        return [
            CountryFilter::create()->title("Countries"),
            HighCreditFilter::create()->title("Credit Limit > $120k")
        ];
    }

    protected function glasses()
    {
        return [
            MostValuedCustomers::create()
        ];
    }

    protected function fields()
    {
        return [
            ID::create("customerNumber")
                ->searchable(true)
                ->sortable(true)
                ->validators([
                    RequiredFieldValidator::create(),
                    NumericValidator::create(),
                ]),

            Text::create("customerName")
                ->searchable(true)
                ->sortable(true),

            Text::create("country")
                ->searchable(true)
                ->sortable(true),

            Currency::create("creditLimit")
                ->USD()->symbol()
                ->sortable(true),
        ];
    }
}