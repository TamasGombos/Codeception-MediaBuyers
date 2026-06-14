<?php

declare(strict_types=1);

namespace Tests\Api;

use Tests\Support\ApiTester;

final class MediaBuyersGetCest
{
    public function _before(ApiTester $I): void
    {
        $I->setUpApiHeaders();
    }

    public function apiReturnsAValidJsonAgainstSchema(ApiTester $I): void
    {
        $I->sendGet('/api/mediabuyers');
        $I->seeResponseCodeIs(200);
        $I->seeHttpHeader('Content-Type', 'application/json; charset=utf-8');
        $I->seeResponseContainsJson(array('data' => []));
        $I->validateResponseJsonSchema('get');
    }

    public function apiReturnsValidDataInFieldsNotSpecifiedBySchema(ApiTester $I): void
    {
        $response = $I->sendGet('/api/mediabuyers');
        $I->validateResponseValues($response);
        $I->validateIdUniqueness($response);
    }
}
