<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Service\CalculateHolidays;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = self::createClient();
        $client->request('GET', ('/'));
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     *
     *
     * @param CalculateHolidays $holidays
     * @return void
     * @dataProvider dataHolidays
     */
    public function testDateOFHolidays($testHolidays)
    {
        $holiday = new CalculateHolidays();

        $year = new \Datetime();
        $daysOff = $holiday->dayOff($year);
        $this->assertEquals($testHolidays, $daysOff);
    }
    public function dataHolidays()
    {
        return [
            [date('D d M Y', '2019-01-01')],
            [date('D d M Y', '2019-05-01')],
            [date('D d M Y', '2019-11-01')],
            [date('D d M Y', '2019-11-11')],
            [date('D d M Y', '2019-12-25')],
        ];
    }
}