<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        try {
            view()->composer('*', function ($view){
                $mydata['links']             = \App\Model\Link::get();
                $mydata['sessionOut'] = \App\Model\PortalSetting::where('code', 'sessionout')->first()->value;
                $mydata['complaintsubject'] = \App\Model\Complaintsubject::get();
                $mydata['company'] = \App\Model\Company::where('website', $_SERVER['HTTP_HOST'])->first();
                $mydata['topheadcolor'] = \App\Model\PortalSetting::where('code', "topheadcolor")->first();
                $mydata['sidebarlightcolor'] = \App\Model\PortalSetting::where('code', "sidebarlightcolor")->first();
                $mydata['sidebardarkcolor'] = \App\Model\PortalSetting::where('code', "sidebardarkcolor")->first();
                $mydata['sidebariconcolor'] = \App\Model\PortalSetting::where('code', "sidebariconcolor")->first();
                $mydata['sidebarchildhrefcolor'] = \App\Model\PortalSetting::where('code', "sidebarchildhrefcolor")->first();
                $mydata['sidebarchildhrefcolor'] = \App\Model\PortalSetting::where('code', "sidebarchildhrefcolor")->first();
                $mydata['whitelable_service'] = \App\Model\PortalSetting::where('code', "whitelable_service")->first();
                $mydata['apiuser_service'] = \App\Model\PortalSetting::where('code', "apiuser_service")->first();

                if($mydata['company']){
                    $news = \App\Model\Companydata::where('company_id', $mydata['company']->id)->first();
                    $mydata['supportnumber'] = isset($news->number)?$news->number : "";
                    $mydata['supportemail']  = isset($news->email)?$news->email : "";
                }else{
                    $mydata['supportnumber'] = "";
                    $mydata['supportemail']  = "";
                }
                
                if($mydata['company']){
                    $news = \App\Model\Companydata::where('company_id', $mydata['company']->id)->first();
                    $user=\App\User::where('company_id', $mydata['company']->id)->first();
                }else{
                    $news = null;
                    $user=null;
                }
                if (\Auth::check()) {
                    if($mydata['company'] && $news){
                        $mydata['news'] = $news->news;
                        $mydata['notice'] = $news->notice;
                        $mydata['billnotice'] = $news->billnotice;
                        
                    }else{
                        $mydata['news'] = "";
                        $mydata['notice'] = "";
                        $mydata['billnotice'] = "";
                    }
                    $mydata['downlinebalance'] = \App\User::whereIn('id', session('parentData'))->where('id', '!=',\Auth::id())->sum('mainwallet');
                }
                
                if($user){
                  $mydata['address'] = $user->address; 
                  $mydata['city'] = $user->city; 
                }
                else{
                   $mydata['address']=""; 
                   $mydata['city']="";
                }
                $view->with('mydata', $mydata);    
            }); 
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
