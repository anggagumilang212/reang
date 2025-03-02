<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-speedometer2" style="line-height: 1;"></i> {{ __('messages.home') }}
    </a>
</li>
@can('access_branch_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi  bi-shop-window" style="line-height: 1;"></i> {{ __('messages.branches') }}
            {{ __('messages.management') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('branchs.index') ? 'c-active' : '' }}"
                    href="{{ route('branchs.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-shop-window"
                        style="line-height: 1;"></i>{{ __('messages.branches') }}
                </a>
            </li>
        </ul>
    </li>
@endcan
@can('access_products')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('products.*') || request()->routeIs('product-categories.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-journal-bookmark" style="line-height: 1;"></i> {{ __('messages.products') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_product_categories')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('product-categories.*') ? 'c-active' : '' }}"
                        href="{{ route('product-categories.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i>
                        {{ __('messages.category') }}
                    </a>
                </li>
            @endcan
            @can('create_products')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('products.create') ? 'c-active' : '' }}"
                        href="{{ route('products.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.createproduct') }}
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('products.index') ? 'c-active' : '' }}"
                    href="{{ route('products.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_products') }}
                </a>
            </li>
            @can('print_barcodes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'c-active' : '' }}"
                        href="{{ route('barcode.print') }}">
                        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> {{ __('messages.print') }}
                        Barcode
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
@can('access_stock_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi  bi-archive" style="line-height: 1;"></i> {{ __('messages.stock') }}
            {{ __('messages.management') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_transfer_stock')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('transferstock.index') ? 'c-active' : '' }}"
                        href="{{ route('transferstock.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-folder-minus"
                            style="line-height: 1;"></i>{{ __('messages.transfer_stock') }}
                    </a>
                </li>
            @endcan
            @can('access_product_stock')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('productstocks.index') ? 'c-active' : '' }}"
                        href="{{ route('productstocks.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i>
                        {{ __('messages.product_stock') }}
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan


{{-- @can('access_adjustments')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('adjustments.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> Stock Adjustments
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('create_adjustments')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('adjustments.create') ? 'c-active' : '' }}"
                        href="{{ route('adjustments.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Create Adjustment
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('adjustments.index') ? 'c-active' : '' }}"
                    href="{{ route('adjustments.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> All Adjustments
                </a>
            </li>
        </ul>
    </li>
@endcan --}}

@can('access_quotations')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('quotations.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-cart-check" style="line-height: 1;"></i> {{ __('messages.quotations') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('create_adjustments')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.create') ? 'c-active' : '' }}"
                        href="{{ route('quotations.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.quotations') }}
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.index') ? 'c-active' : '' }}"
                    href="{{ route('quotations.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_quotations') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_purchases')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('purchases.*') || request()->routeIs('purchase-payments*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-bag" style="line-height: 1;"></i> {{ __('messages.purchases') }}
        </a>
        @can('create_purchase')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.create') ? 'c-active' : '' }}"
                        href="{{ route('purchases.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.purchases') }}
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.index') ? 'c-active' : '' }}"
                    href="{{ route('purchases.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.purchases') }}
                </a>
            </li>
        </ul>
    </li> `
@endcan

@can('access_purchase_returns')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('purchase-returns.*') || request()->routeIs('purchase-return-payments.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-arrow-return-right" style="line-height: 1;"></i>
            {{ __('messages.purchase_returns') }}
        </a>
        @can('create_purchase_returns')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.create') ? 'c-active' : '' }}"
                        href="{{ route('purchase-returns.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.purchase_returns') }}
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.index') ? 'c-active' : '' }}"
                    href="{{ route('purchase-returns.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_purchase_returns') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_sales')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('sales.*') || request()->routeIs('sale-payments*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-receipt" style="line-height: 1;"></i> {{ __('messages.sales') }}
        </a>
        @can('create_sales')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('sales.create') ? 'c-active' : '' }}"
                        href="{{ route('sales.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.sales') }}
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('sales.index') ? 'c-active' : '' }}"
                    href="{{ route('sales.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_sales') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_sale_returns')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('sale-returns.*') || request()->routeIs('sale-return-payments.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-arrow-return-left" style="line-height: 1;"></i>
            {{ __('messages.sales_returns') }}
        </a>
        @can('create_sale_returns')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.create') ? 'c-active' : '' }}"
                        href="{{ route('sale-returns.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.sales_returns') }}
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.index') ? 'c-active' : '' }}"
                    href="{{ route('sale-returns.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_sales_returns') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_expenses')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('expenses.*') || request()->routeIs('expense-categories.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-wallet2" style="line-height: 1;"></i> {{ __('messages.expenses') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_expense_categories')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('expense-categories.*') ? 'c-active' : '' }}"
                        href="{{ route('expense-categories.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i>
                        {{ __('messages.category') }}
                    </a>
                </li>
            @endcan
            @can('create_expenses')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.create') ? 'c-active' : '' }}"
                        href="{{ route('expenses.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i>
                        {{ __('messages.create') }} {{ __('messages.expenses') }}
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.index') ? 'c-active' : '' }}"
                    href="{{ route('expenses.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i>
                    {{ __('messages.all_expenses') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_customers|access_suppliers')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('customers.*') || request()->routeIs('suppliers.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> {{ __('messages.person') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_customers')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('customers.*') ? 'c-active' : '' }}"
                        href="{{ route('customers.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i>
                        {{ __('messages.customer') }}
                    </a>
                </li>
            @endcan
            @can('access_suppliers')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('suppliers.*') ? 'c-active' : '' }}"
                        href="{{ route('suppliers.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i>
                        {{ __('messages.supplier') }}
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('access_reports')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('*-report.index') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-graph-up" style="line-height: 1;"></i>{{ __('messages.reports') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('closingkasir.index') ? 'c-active' : '' }}"
                    href="{{ route('closingkasir.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Closing Kasir
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('profit-loss-report.index') ? 'c-active' : '' }}"
                    href="{{ route('profit-loss-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.profit_and_loss_report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('payments-report.index') ? 'c-active' : '' }}"
                    href="{{ route('payments-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.payment_report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('sales-report.index') ? 'c-active' : '' }}"
                    href="{{ route('sales-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.sales_report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('expenses-report.index') ? 'c-active' : '' }}"
                    href="{{ route('expenses-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.expenses_report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-report.index') ? 'c-active' : '' }}"
                    href="{{ route('purchases-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.purchases') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('sales-return-report.index') ? 'c-active' : '' }}"
                    href="{{ route('sales-return-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.sales_returns') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-return-report.index') ? 'c-active' : '' }}"
                    href="{{ route('purchases-return-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i>
                    {{ __('messages.purchase_return_report') }}

                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_tags|access_posts|access_post_categories')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('posts*', 'tags*', 'post-categories*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-layout-text-window" style="line-height: 1;"></i>
            {{ __('messages.post') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('posts*') ? 'c-active' : '' }}"
                    href="{{ route('posts.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-richtext"
                        style="line-height: 1;"></i>{{ __('messages.all_posts') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('tags*') ? 'c-active' : '' }}"
                    href="{{ route('tags.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-tags" style="line-height: 1;"></i> {{ __('messages.all_tags') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('post-categories*') ? 'c-active' : '' }}"
                    href="{{ route('post-categories.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-grid" style="line-height: 1;"></i>
                    {{ __('messages.post_categories') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_user_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> {{ __('messages.user_management') }}
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'c-active' : '' }}"
                    href="{{ route('users.create') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i>
                    {{ __('messages.add') }} {{ __('messages.users') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users.index') ? 'c-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-lines-fill"
                        style="line-height: 1;"></i>{{ __('messages.all_users') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'c-active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> {{ __('messages.roles') }} &
                    {{ __('messages.permissions') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_testimonis')
    {{-- Testimoni --}}
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ request()->routeIs('testimonis*') ? 'c-active' : '' }}"
            href="{{ route('testimonis.index') }}">
            <i class="c-sidebar-nav-icon bi bi-chat" style="line-height: 1;"></i> {{ __('messages.testimoni') }}
        </a>
    </li>
@endcan
@can('access_media_reviews')
    {{-- Media Product Review --}}
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ request()->routeIs('mediareview*') ? 'c-active' : '' }}"
            href="{{ route('mediareview.index') }}">
            <i class="c-sidebar-nav-icon bi bi-image" style="line-height: 1;"></i>
            {{ __('messages.product_media_review') }}
        </a>
    </li>
@endcan
@can('access_transactions')
    {{-- transaction --}}
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ request()->routeIs('transactions*') ? 'c-active' : '' }}"
            href="{{ route('transactions.index') }}">
            <i class="c-sidebar-nav-icon bi bi-currency-exchange" style="line-height: 1;"></i>
            {{ __('messages.transactions') }}
        </a>
    </li>
@endcan


@can('access_currencies|access_settings')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('currencies*') || request()->routeIs('units*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i> {{ __('messages.settings') }}
        </a>
        @can('access_units')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('units*') ? 'c-active' : '' }}"
                        href="{{ route('units.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-calculator" style="line-height: 1;"></i>
                        {{ __('messages.unit') }}
                    </a>
                </li>
            </ul>
        @endcan
        @can('access_currencies')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('currencies*') ? 'c-active' : '' }}"
                        href="{{ route('currencies.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-cash-stack" style="line-height: 1;"></i>
                        {{ __('messages.currency') }}
                    </a>
                </li>
            </ul>
        @endcan
        @can('access_settings')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}"
                        href="{{ route('settings.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i>
                        {{ __('messages.system_settings') }}
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('banners*') ? 'c-active' : '' }}"
                    href="{{ route('banners.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-images" style="line-height: 1;"></i>
                    {{ __('messages.banner_manajemen') }}
                </a>
            </li>
        </ul>
    </li>
@endcan

<li class="c-sidebar-nav-item {{ request()->routeIs('/panduan') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="/panduan">
        <i class="c-sidebar-nav-icon bi bi-question-circle" style="line-height: 1;"></i>
        {{ __('messages.guidebook') }}
    </a>
</li>
<li class="c-sidebar-nav-item {{ request()->routeIs('/') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('public.home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> ReangNET
    </a>
</li>
