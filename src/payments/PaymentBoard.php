<?php

namespace demo\payments;

use \koolreport\dashboard\Dashboard;
use \koolreport\dashboard\containers\Row;
use \koolreport\dashboard\containers\Panel;
use \koolreport\dashboard\widgets\Text;

class PaymentBoard extends Dashboard
{
    protected function widgets()
    {
        return [
            Row::create()->sub([
                Row::create(),
                PaymentDateRange::create()->width(1/3),
            ]),
            Row::create()->sub([
                Panel::create()->sub([
                    PaymentByDate::create(),
                ])->width(1/2),
                Panel::create()->sub([
                    PaymentByCustomer::create()
                ])->width(1/2),    
            ]),
            PaymentTable::create(),

            \demo\CodeDemo::create("
                This example shows us the status of payment received. The top date range picker allows us to
                choose the range of date that we want, by default it will show this month range and you can
                change to any range that you want. Upon selecing the date range, the charts and table below
                will show detail payment status within that range. The ColumnChart on the left will show you
                payment broken by date while the BarChart on the right show you payment by customers.
                The table on below will list all detail payments that we received on that range.         
            ")
        ];
    }
}