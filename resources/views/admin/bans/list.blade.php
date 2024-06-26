@php use App\Helpers\PermissionsHelper; @endphp
<x-base-layout :scrollspy="false">
    <x-slot:pageTitle>
        {{ __('dashboard.bans') }} - CSS-BANS
    </x-slot>
    @vite(['resources/scss/dark/assets/components/datatable.scss'])
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
    </x-slot>
    @if (session('success'))
        <x-alert type="success" :message="session('success')"/>
    @endif
    @if (session('error'))
        <x-alert type="danger" :message="session('error')"/>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="mb-12">
        <div class="card">
            @if(PermissionsHelper::hasBanPermission())
                <div class="mt-3 d-flex justify-content-end p-1">
                    <a href="{{env('VITE_SITE_DIR')}}/ban/add" class="col-md- btn btn-success">{{ __('admins.addBans') }}</a>
                </div>
            @endif
            <div class="card-header text-center py-3">
                <h5 class="mb-0 text-center">
                    <strong>{{ __('dashboard.bans') }}</strong>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive display responsive nowrap">
                    <table class="table table-hover " id="bansList" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('admins.id') }}</th>
                            <th scope="col">{{ __('dashboard.player') }}</th>
                            <th scope="col">{{ __('dashboard.ip') }}</th>
                            <th scope="col">{{ __('admins.bannedBy') }}</th>
                            <th scope="col">{{ __('admins.banReason') }}</th>
                            <th scope="col">{{ __('admins.banDuration') }}</th>
                            <th scope="col">{{ __('admins.ends') }}</th>
                            <th scope="col">{{ __('admins.banned') }}</th>
                            <th scope="col">{{ __('dashboard.server') }}</th>
                            <th scope="col">{{ __('admins.status') }}</th>
                            <th scope="col">{{ __('admins.action') }}</th>
                            <th scope="col">{{ __('admins.progress') }}</th>
                        </tr>
                        </thead>
                        <tbody id="serverList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script>
            function getPlayerUnBanUrl(playerSteamid) {
                return "{!! env('VITE_SITE_DIR') !!}/players/"+playerSteamid+"/unban";
            }
            const bansListUrl = '{!! env('VITE_SITE_DIR') !!}/list/bans';
        </script>
        @vite(['resources/js/bans/bans.ts'])
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    </x-slot>
</x-base-layout>

