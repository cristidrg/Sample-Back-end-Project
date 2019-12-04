<?php

namespace App\Http\Controllers;

use App\Org;
use App\Prop;
use Illuminate\Http\Request;
use App\Services\SiteImproveService;

use Spatie\UptimeMonitor\Models\Monitor;

class SiteImproveController extends Controller
{
    public function updateProps(SiteImproveService $service)
    {
        $sites = $service->getSites();
        $unorganizedOrg = Org::where('title', 'Unorganized')->first();

        $updatedProps = 0;
        $createdProps = 0;

        foreach($sites as $site) {
            $propEntry = Prop::where('siteImproveId', '=', $site['siteImproveId'])
                            ->orWhere('url', '=', $site['url'])
                            ->get()
                            ->first();

            if ($propEntry !== null){
                $propEntry->update($site);

                $updatedProps = $updatedProps + 1;
            } else {
                $prop = Prop::create($site);
                $prop->monitor()->save(Monitor::create(['url' => $site['url']]));
                $unorganizedOrg->props()->save($prop);

                $createdProps = $createdProps + 1;
            }
        }

        dd("Created " . $createdProps . " props and updated " . $updatedProps ." props.");
    }
}
