<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        
        return view('calculator');
         
    }

    public function calculate( Request $request){
        
        $result=0;
             
        switch ($request->operator) {
            case 'add':
               $result =  $request->current + $request->previous;                          
               break;
           case 'minus':
               $result = $request->previous - $request->current  ;
                            
               break;
           case 'divide':    
                $result = $request->previous / $request->current  ;
                       
                break;
           case 'times':    
                $result = $request->current * $request->previous;
                            
                break;
        }

        return response()->JSON([
            'result' => $result,  
        ]);
        
    }
    
}