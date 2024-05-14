<?php

namespace App\Http\Controllers;

use App\Models\OldRecord;
use Illuminate\Http\Request;

class OldRecordController extends Controller
{

    public function magento()
    {
        // Retrieve Magento old records
        $magentoOldRecords = OldRecord::where('technology', 'Magento')->get();
        
        // Return the view with Magento old records data
        return view('old_records.magento', ['magentoOldRecords' => $magentoOldRecords]);
    }
    public function java()
    {
        // Retrieve Magento old records
        $magentoOldRecords = OldRecord::where('technology', 'java')->get();
        
        // Return the view with Magento old records data
        return view('old_records.java', ['magentoOldRecords' => $magentoOldRecords]);
    }
    public function Python()
    {
        // Retrieve Magento old records
        $magentoOldRecords = OldRecord::where('technology', 'python')->get();
        
        // Return the view with Magento old records data
        return view('old_records.python', ['magentoOldRecords' => $magentoOldRecords]);
    }
}
