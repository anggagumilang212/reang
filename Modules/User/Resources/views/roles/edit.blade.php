@extends('layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('messages.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{__('messages.roles')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.edit')}} </li>
    </ol>
@endsection

@push('page_css')
    <style>
        .custom-control-label {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('utils.alerts')
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{__('messages.update')}} {{__('messages.roles')}} <i class="bi bi-check"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('messages.name')}} <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required
                                    value="{{ $role->name }}">
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="permissions">
                                    {{__('messages.permissions')}} <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">{{__('messages.give_all_permissions')}}</label>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dashboard Permissions -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                        {{__('messages.home')}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_total_stats" name="permissions[]"
                                                            value="show_total_stats"
                                                            {{ $role->hasPermissionTo('show_total_stats') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_total_stats">{{__('messages.total_stats')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_notifications" name="permissions[]"
                                                            value="show_notifications"
                                                            {{ $role->hasPermissionTo('show_notifications') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_notifications">{{__('messages.notifications')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_month_overview" name="permissions[]"
                                                            value="show_month_overview"
                                                            {{ $role->hasPermissionTo('show_month_overview') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_month_overview">{{__('messages.month_overview')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_weekly_sales_purchases" name="permissions[]"
                                                            value="show_weekly_sales_purchases"
                                                            {{ $role->hasPermissionTo('show_weekly_sales_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_weekly_sales_purchases">{{__('messages.weekly_sales_purchases')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_monthly_cashflow" name="permissions[]"
                                                            value="show_monthly_cashflow"
                                                            {{ $role->hasPermissionTo('show_monthly_cashflow') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_monthly_cashflow">{{__('messages.monthly_cashflow')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Management Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                        {{__('messages.user_management')}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_user_management" name="permissions[]"
                                                            value="access_user_management"
                                                            {{ $role->hasPermissionTo('access_user_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_user_management">{{__('messages.access')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_own_profile" name="permissions[]"
                                                            value="edit_own_profile"
                                                            {{ $role->hasPermissionTo('edit_own_profile') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_own_profile">{{__('messages.own_profile')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Branch Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                        {{__('messages.branches')}} {{__('messages.management')}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_branch_management" name="permissions[]"
                                                            value="access_branch_management"
                                                            {{ $role->hasPermissionTo('access_branch_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_branch_management">{{__('messages.access')}}</label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_branchs" name="permissions[]"
                                                            value="create_branchs"
                                                            {{ $role->hasPermissionTo('create_branchs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_branchs">{{__('messages.create')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_branchs" name="permissions[]" value="edit_branchs"
                                                            {{ $role->hasPermissionTo('edit_branchs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_branchs">{{__('messages.edit')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_branchs" name="permissions[]"
                                                            value="delete_branchs"
                                                            {{ $role->hasPermissionTo('delete_branchs') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_branchs">{{__('messages.delete')}}</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Stock Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{__('messages.stock')}} {{__('messages.management')}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_stock_management" name="permissions[]"
                                                            value="access_stock_management"
                                                            {{ $role->hasPermissionTo('access_stock_management') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_stock_management">{{__('messages.access')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_transfer_stock" name="permissions[]"
                                                            value="access_transfer_stock"
                                                            {{ $role->hasPermissionTo('access_transfer_stock') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_transfer_stock">{{__('messages.transfer_stock')}}</label>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_product_stock" name="permissions[]"
                                                            value="access_product_stock"
                                                            {{ $role->hasPermissionTo('access_product_stock') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_product_stock">{{__('messages.product_stock')}}</label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Products Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{__('messages.products')}} 
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_products" name="permissions[]"
                                                            value="access_products"
                                                            {{ $role->hasPermissionTo('access_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_products">{{__('messages.access')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_products" name="permissions[]" value="show_products"
                                                            {{ $role->hasPermissionTo('show_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_products">{{__('messages.view')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_products" name="permissions[]"
                                                            value="create_products"
                                                            {{ $role->hasPermissionTo('create_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_products">{{__('messages.create')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_products" name="permissions[]" value="edit_products"
                                                            {{ $role->hasPermissionTo('edit_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_products">{{__('messages.edit')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_products" name="permissions[]"
                                                            value="delete_products"
                                                            {{ $role->hasPermissionTo('delete_products') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_products">{{__('messages.delete')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_product_categories" name="permissions[]"
                                                            value="access_product_categories"
                                                            {{ $role->hasPermissionTo('access_product_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_product_categories">{{__('messages.category')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="print_barcodes" name="permissions[]"
                                                            value="print_barcodes"
                                                            {{ $role->hasPermissionTo('print_barcodes') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="print_barcodes">{{__('messages.print_barcodes')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Adjustments Permission -->
                                {{-- <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            Adjustments
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_adjustments" name="permissions[]"
                                                            value="access_adjustments"
                                                            {{ $role->hasPermissionTo('access_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_adjustments">Access</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_adjustments" name="permissions[]"
                                                            value="create_adjustments"
                                                            {{ $role->hasPermissionTo('create_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_adjustments">Create</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_adjustments" name="permissions[]"
                                                            value="show_adjustments"
                                                            {{ $role->hasPermissionTo('show_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_adjustments">View</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_adjustments" name="permissions[]"
                                                            value="edit_adjustments"
                                                            {{ $role->hasPermissionTo('edit_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_adjustments">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_adjustments" name="permissions[]"
                                                            value="delete_adjustments"
                                                            {{ $role->hasPermissionTo('delete_adjustments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_adjustments">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Quotations Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                           {{ __('messages.quotations') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_quotations" name="permissions[]"
                                                            value="access_quotations"
                                                            {{ $role->hasPermissionTo('access_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_quotations">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_quotations" name="permissions[]"
                                                            value="create_quotations"
                                                            {{ $role->hasPermissionTo('create_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_quotations">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_quotations" name="permissions[]"
                                                            value="show_quotations"
                                                            {{ $role->hasPermissionTo('show_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_quotations">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_quotations" name="permissions[]"
                                                            value="edit_quotations"
                                                            {{ $role->hasPermissionTo('edit_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_quotations">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_quotations" name="permissions[]"
                                                            value="delete_quotations"
                                                            {{ $role->hasPermissionTo('delete_quotations') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_quotations">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="send_quotation_mails" name="permissions[]"
                                                            value="send_quotation_mails"
                                                            {{ $role->hasPermissionTo('send_quotation_mails') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="send_quotation_mails">{{ __('messages.send_email') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_quotation_sales" name="permissions[]"
                                                            value="create_quotation_sales"
                                                            {{ $role->hasPermissionTo('create_quotation_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_quotation_sales">{{ __('messages.create') }} {{ __('messages.sale_from_quotation') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Expenses Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{ __('messages.expenses') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_expenses" name="permissions[]"
                                                            value="access_expenses"
                                                            {{ $role->hasPermissionTo('access_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_expenses">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_expenses" name="permissions[]"
                                                            value="create_expenses"
                                                            {{ $role->hasPermissionTo('create_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_expenses">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_expenses" name="permissions[]" value="edit_expenses"
                                                            {{ $role->hasPermissionTo('edit_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_expenses">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_expenses" name="permissions[]"
                                                            value="delete_expenses"
                                                            {{ $role->hasPermissionTo('delete_expenses') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_expenses">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_expense_categories" name="permissions[]"
                                                            value="access_expense_categories"
                                                            {{ $role->hasPermissionTo('access_expense_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_expense_categories">{{ __('messages.category') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customers Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{ __('messages.customer') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_customers" name="permissions[]"
                                                            value="access_customers"
                                                            {{ $role->hasPermissionTo('access_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_customers">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_customers" name="permissions[]"
                                                            value="create_customers"
                                                            {{ $role->hasPermissionTo('create_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_customers">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_customers" name="permissions[]"
                                                            value="show_customers"
                                                            {{ $role->hasPermissionTo('show_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_customers">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_customers" name="permissions[]"
                                                            value="edit_customers"
                                                            {{ $role->hasPermissionTo('edit_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_customers">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_customers" name="permissions[]"
                                                            value="delete_customers"
                                                            {{ $role->hasPermissionTo('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_customers">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Suppliers Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{ __('messages.supplier') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_suppliers" name="permissions[]"
                                                            value="access_suppliers"
                                                            {{ $role->hasPermissionTo('access_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_suppliers">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_suppliers" name="permissions[]"
                                                            value="create_suppliers"
                                                            {{ $role->hasPermissionTo('create_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_suppliers">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_suppliers" name="permissions[]"
                                                            value="show_suppliers"
                                                            {{ $role->hasPermissionTo('show_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_suppliers">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_suppliers" name="permissions[]"
                                                            value="edit_suppliers"
                                                            {{ $role->hasPermissionTo('edit_suppliers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_suppliers">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_customers" name="permissions[]"
                                                            value="delete_customers"
                                                            {{ $role->hasPermissionTo('delete_customers') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_customers">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sales Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{ __('messages.sales') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_sales" name="permissions[]" value="access_sales"
                                                            {{ $role->hasPermissionTo('access_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_sales">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_sales" name="permissions[]" value="create_sales"
                                                            {{ $role->hasPermissionTo('create_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_sales">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_sales" name="permissions[]" value="show_suppliers"
                                                            {{ $role->hasPermissionTo('show_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_sales">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_sales" name="permissions[]" value="edit_sales"
                                                            {{ $role->hasPermissionTo('edit_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_sales">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_sales" name="permissions[]" value="delete_sales"
                                                            {{ $role->hasPermissionTo('delete_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_sales">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_pos_sales" name="permissions[]"
                                                            value="create_pos_sales"
                                                            {{ $role->hasPermissionTo('create_pos_sales') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="create_pos_sales">{{ __('messages.pos') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_sale_payments" name="permissions[]"
                                                            value="access_sale_payments"
                                                            {{ $role->hasPermissionTo('access_sale_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_sale_payments">{{ __('messages.payment') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sale Returns Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                           {{ __('messages.sales_returns') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_sale_returns" name="permissions[]"
                                                            value="access_sale_returns"
                                                            {{ $role->hasPermissionTo('access_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_sale_returns">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_sale_returns" name="permissions[]"
                                                            value="create_sale_returns"
                                                            {{ $role->hasPermissionTo('create_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_sale_returns">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_sale_returns" name="permissions[]"
                                                            value="show_sale_returns"
                                                            {{ $role->hasPermissionTo('show_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_sale_returns">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_sale_returns" name="permissions[]"
                                                            value="edit_sale_returns"
                                                            {{ $role->hasPermissionTo('edit_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_sale_returns">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_sale_returns" name="permissions[]"
                                                            value="delete_sale_returns"
                                                            {{ $role->hasPermissionTo('delete_sale_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_sale_returns">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_sale_return_payments" name="permissions[]"
                                                            value="access_sale_return_payments"
                                                            {{ $role->hasPermissionTo('access_sale_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_sale_return_payments">{{ __('messages.payment') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchases Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.purchases') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_purchases" name="permissions[]"
                                                            value="access_purchases"
                                                            {{ $role->hasPermissionTo('access_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_purchases">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_purchases" name="permissions[]"
                                                            value="create_purchases"
                                                            {{ $role->hasPermissionTo('create_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_purchases">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_purchases" name="permissions[]"
                                                            value="show_purchases"
                                                            {{ $role->hasPermissionTo('show_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_purchases">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_purchases" name="permissions[]"
                                                            value="edit_purchases"
                                                            {{ $role->hasPermissionTo('edit_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_purchases">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_purchases" name="permissions[]"
                                                            value="delete_purchases"
                                                            {{ $role->hasPermissionTo('delete_purchases') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_purchases">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_purchase_payments" name="permissions[]"
                                                            value="access_purchase_payments"
                                                            {{ $role->hasPermissionTo('access_purchase_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_purchase_payments">{{ __('messages.payment') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchases Returns Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                           {{ __('messages.purchase_returns') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_purchase_returns" name="permissions[]"
                                                            value="access_purchase_returns"
                                                            {{ $role->hasPermissionTo('access_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_purchase_returns">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_purchase_returns" name="permissions[]"
                                                            value="create_purchase_returns"
                                                            {{ $role->hasPermissionTo('create_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_purchase_returns">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_purchase_returns" name="permissions[]"
                                                            value="show_purchase_returns"
                                                            {{ $role->hasPermissionTo('show_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_purchase_returns">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_purchase_returns" name="permissions[]"
                                                            value="edit_purchase_returns"
                                                            {{ $role->hasPermissionTo('edit_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_purchase_returns">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_purchase_returns" name="permissions[]"
                                                            value="delete_purchase_returns"
                                                            {{ $role->hasPermissionTo('delete_purchase_returns') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_purchase_returns">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_purchase_return_payments" name="permissions[]"
                                                            value="access_purchase_return_payments"
                                                            {{ $role->hasPermissionTo('access_purchase_return_payments') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_purchase_return_payments">{{ __('messages.payment') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Currencies Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.currency') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_currencies" name="permissions[]"
                                                            value="access_currencies"
                                                            {{ $role->hasPermissionTo('access_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_currencies">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_currencies" name="permissions[]"
                                                            value="create_currencies"
                                                            {{ $role->hasPermissionTo('create_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_currencies">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_currencies" name="permissions[]"
                                                            value="edit_currencies"
                                                            {{ $role->hasPermissionTo('edit_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_currencies">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_currencies" name="permissions[]"
                                                            value="delete_currencies"
                                                            {{ $role->hasPermissionTo('delete_currencies') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_currencies">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Posts Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.post') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_posts" name="permissions[]" value="access_posts"
                                                            {{ $role->hasPermissionTo('access_posts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_posts">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_posts" name="permissions[]" value="create_posts"
                                                            {{ $role->hasPermissionTo('create_posts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_posts">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_posts" name="permissions[]" value="show_posts"
                                                            {{ $role->hasPermissionTo('show_posts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="show_posts">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_posts" name="permissions[]" value="edit_posts"
                                                            {{ $role->hasPermissionTo('edit_posts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_posts">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_posts" name="permissions[]" value="delete_posts"
                                                            {{ $role->hasPermissionTo('delete_posts') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_posts">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Post Categories Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.post_category') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_post_categories" name="permissions[]"
                                                            value="access_post_categories"
                                                            {{ $role->hasPermissionTo('access_post_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_post_categories">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_post_categories" name="permissions[]"
                                                            value="create_post_categories"
                                                            {{ $role->hasPermissionTo('create_post_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_post_categories">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_post_categories" name="permissions[]"
                                                            value="show_post_categories"
                                                            {{ $role->hasPermissionTo('show_post_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_post_categories">{{ __('messages.view') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_post_categories" name="permissions[]"
                                                            value="edit_post_categories"
                                                            {{ $role->hasPermissionTo('edit_post_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="edit_post_categories">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_post_categories" name="permissions[]"
                                                            value="delete_post_categories"
                                                            {{ $role->hasPermissionTo('delete_post_categories') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_post_categories">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Post Tags Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.post_tag') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_tags" name="permissions[]" value="access_tags"
                                                            {{ $role->hasPermissionTo('access_tags') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_tags">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_tags" name="permissions[]" value="create_tags"
                                                            {{ $role->hasPermissionTo('create_tags') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_tags">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_tags" name="permissions[]" value="edit_tags"
                                                            {{ $role->hasPermissionTo('edit_tags') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_tags">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_tags" name="permissions[]" value="delete_tags"
                                                            {{ $role->hasPermissionTo('delete_tags') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_tags">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reports -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                          {{ __('messages.reports') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_reports" name="permissions[]"
                                                            value="access_reports"
                                                            {{ $role->hasPermissionTo('access_reports') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_reports">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                        <!-- Transaction Permission -->
                                        <div class="col-lg-4 col-md-6 mb-3">
                                            <div class="card h-100 border-0 shadow">
                                                <div class="card-header">
                                                    {{ __('messages.transaction') }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="access_transactions" name="permissions[]"
                                                                    value="access_transactions"
                                                                    {{ $role->hasPermissionTo('access_transactions') ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="access_transactions">{{ __('messages.access') }}</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-6">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="delete_transactions" name="permissions[]"
                                                                    value="delete_transactions"
                                                                    {{ $role->hasPermissionTo('delete_transactions') ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="delete_transactions">{{ __('messages.delete') }}</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
         <!-- Product media review Permission -->
         <div class="col-lg-4 col-md-6 mb-3">
            <div class="card h-100 border-0 shadow">
                <div class="card-header">
                 {{ __('messages.product_media_review') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="access_media_reviews" name="permissions[]"
                                    value="access_media_reviews"
                                    {{ $role->hasPermissionTo('access_media_reviews') ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="access_media_reviews">{{ __('messages.access') }}</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


                                <!-- Testimoni Permission -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.testimoni') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_testimonis" name="permissions[]" value="access_testimonis"
                                                            {{ $role->hasPermissionTo('access_testimonis') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_testimonis">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="show_testimonis" name="permissions[]" value="show_testimonis"
                                                            {{ $role->hasPermissionTo('show_testimonis') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="show_testimonis">{{ __('messages.details') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="create_testimonis" name="permissions[]" value="create_testimonis"
                                                            {{ $role->hasPermissionTo('create_testimonis') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="create_testimonis">{{ __('messages.create') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="edit_testimonis" name="permissions[]" value="edit_testimonis"
                                                            {{ $role->hasPermissionTo('edit_testimonis') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="edit_testimonis">{{ __('messages.edit') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="delete_testimonis" name="permissions[]" value="delete_testimonis"
                                                            {{ $role->hasPermissionTo('delete_testimonis') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="delete_testimonis">{{ __('messages.delete') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Settings -->
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow">
                                        <div class="card-header">
                                            {{ __('messages.settings') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="access_settings" name="permissions[]"
                                                            value="access_settings"
                                                            {{ $role->hasPermissionTo('access_settings') ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="access_settings">{{ __('messages.access') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            })
        });
    </script>
@endpush
