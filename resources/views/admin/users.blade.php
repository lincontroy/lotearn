@php
    $search = request('search');
    $searchField = request('search_field', 'all');
    
    // Base query
    $usersQuery = App\Models\User::query();
    
    // Apply search if provided
    if ($search) {
        switch ($searchField) {
            case 'id':
                $usersQuery->where('id', $search);
                break;
            case 'name':
                $usersQuery->where('name', 'like', "%{$search}%");
                break;
            case 'email':
                $usersQuery->where('email', 'like', "%{$search}%");
                break;
            case 'phone':
                $usersQuery->where('phone', 'like', "%{$search}%");
                break;
            case 'country':
                $usersQuery->where('country', 'like', "%{$search}%");
                break;
            case 'status':
                // Remove status search since column doesn't exist
                $usersQuery->where('name', 'like', "%{$search}%");
                break;
            case 'all':
            default:
                $usersQuery->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%")
                          ->orWhere('country', 'like', "%{$search}%")
                          ->orWhere('id', 'like', "%{$search}%");
                          // Removed status from search since column doesn't exist
                });
                break;
        }
    }
    
    $totalUsers = App\Models\User::count();
    $users = $usersQuery->orderBy('id', 'desc')->paginate(10);
    $totalBalance = App\Models\User::sum('wallet_balance');
    $newUsers = App\Models\User::where('created_at', '>=', now()->subDays(30))->count();
@endphp

@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">
            <i class="fas fa-users mr-2"></i>
            Users Management
        </h1>
    </div>
@stop

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
   
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>USD {{ number_format($totalBalance, 2) }}</h3>
                <p>Total Collected</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $newUsers }}</h3>
                <p>New This Month</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $users->total() }}</h3>
                <p>Search Results</p>
            </div>
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
</div>

<!-- Search Card -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">
            <i class="fas fa-search mr-1"></i>
            Search Users
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="" id="searchForm">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label for="search_field">Search By:</label>
                    <select name="search_field" id="search_field" class="form-control">
                        <option value="all" {{ $searchField == 'all' ? 'selected' : '' }}>All Fields</option>
                        <option value="id" {{ $searchField == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="name" {{ $searchField == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="email" {{ $searchField == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="phone" {{ $searchField == 'phone' ? 'selected' : '' }}>Phone</option>
                        <option value="country" {{ $searchField == 'country' ? 'selected' : '' }}>Country</option>
                        <!-- Removed status option since column doesn't exist -->
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="search">Search Term:</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" 
                               placeholder="Enter search term..." value="{{ $search }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <label>&nbsp;</label>
                    <div>
                        @if($search)
                            <a href="{{ url()->current() }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-times"></i> Clear Search
                            </a>
                        @else
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search"></i> Search
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($search)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info py-2">
                            <i class="fas fa-info-circle mr-2"></i>
                            Showing results for: 
                            <strong>"{{ $search }}"</strong> 
                            in <strong>{{ ucfirst($searchField) }}</strong>
                            @if($searchField == 'all')
                                (All fields)
                            @endif
                            <a href="{{ url()->current() }}" class="float-right text-danger">
                                <i class="fas fa-times"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            All Users
            @if($search)
                <span class="badge badge-primary ml-2">Search Results</span>
            @endif
        </h3>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" id="tableSearch" class="form-control float-right" 
                       placeholder="Quick search in table...">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" id="usersTable">
            <thead class="bg-light">
                <tr>
                    <th width="50">
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            ID
                            @if(request('sort') == 'id')
                                <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th width="60">Avatar</th>
                    <th>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Name
                            @if(request('sort') == 'name')
                                <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort' => 'email', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Email
                            @if(request('sort') == 'email')
                                <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort' => 'wallet_balance', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Balance
                            @if(request('sort') == 'wallet_balance')
                                <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <!-- Removed Status column since it doesn't exist -->
                    <th>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->query(), ['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Joined
                            @if(request('sort') == 'created_at')
                                <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="user-row" data-id="{{ $user->id }}" data-name="{{ strtolower($user->name) }}" 
                    data-email="{{ strtolower($user->email) }}" data-phone="{{ $user->phone ?? '' }}" 
                    data-country="{{ strtolower($user->country ?? '') }}">
                    <td>{{ $user->id }}</td>
                    <td>
                        <div class="user-avatar">
                            @if($user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-circle" width="35" height="35">
                            @else
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if($user->email_verified_at)
                            <i class="fas fa-check-circle text-success ml-1" title="Verified"></i>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country ?? 'Not provided' }}</td>
                    <td>{{ $user->phone ?? 'Not provided' }}</td>
                    <td>
                        <span class="badge badge-success badge-lg">
                            USD {{ number_format($user->wallet_balance ?? 0, 2) }}
                        </span>
                    </td>
                    <!-- Removed status column from table body -->
                    <td>
                        <small class="text-muted" title="{{ $user->created_at->format('M d, Y h:i A') }}">
                            {{ $user->created_at->format('M d, Y') }}
                        </small>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm" onclick="viewUser({{ $user->id }})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="updateBalance({{ $user->id }}, '{{ $user->name }}', {{ $user->wallet_balance ?? 0 }})" title="Update Balance">
                                <i class="fas fa-coins"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="editUser({{ $user->id }})" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})" title="Delete User">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted">
                            @if($search)
                                No users found for "{{ $search }}"
                            @else
                                No users found
                            @endif
                        </p>
                        @if($search)
                            <a href="{{ url()->current() }}" class="btn btn-primary">
                                <i class="fas fa-redo"></i> Show All Users
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }} users
                @if($search)
                    <span class="badge badge-primary ml-2">Search Results</span>
                @endif
            </div>
            <div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Update Balance Modal -->
<div class="modal fade" id="updateBalanceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="fas fa-coins mr-2"></i>
                    Update User Balance
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="updateBalanceForm">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-circle fa-3x text-muted"></i>
                        <h5 class="mt-2" id="modalUserName"></h5>
                    </div>
                    
                    <div class="form-group">
                        <label for="currentBalance">Current Balance</label>
                        <input type="text" class="form-control" id="currentBalance" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="balanceAction">Action</label>
                        <select class="form-control" id="balanceAction" name="action" required>
                            <option value="">Select Action</option>
                            <option value="add">Add to Balance</option>
                            <option value="subtract">Subtract from Balance</option>
                            <option value="set">Set New Balance</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount (USD)</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reason">Reason for Change</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for balance update..." required></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Preview:</strong> <span id="balancePreview">Select an action to see preview</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Update Balance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .table th {
        border-top: none;
    }
    .badge-lg {
        font-size: 0.9em;
        padding: 0.5em 0.8em;
    }
    .user-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
    .small-box {
        border-radius: 10px;
    }
    .modal-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .search-highlight {
        background-color: #fff3cd !important;
    }
    a.sortable {
        color: #495057;
        text-decoration: none;
    }
    a.sortable:hover {
        color: #007bff;
        text-decoration: none;
    }
</style>
@stop

@section('js')
<script>
let currentUserId = null;
let currentUserBalance = 0;

// Update Balance Modal Functions
function updateBalance(userId, userName, balance) {
    currentUserId = userId;
    currentUserBalance = parseFloat(balance);
    
    $('#modalUserName').text(userName);
    $('#currentBalance').val('USD ' + number_format(balance, 2));
    $('#balanceAction').val('');
    $('#amount').val('');
    $('#reason').val('');
    $('#balancePreview').text('Select an action to see preview');
    
    $('#updateBalanceModal').modal('show');
}

// Balance Preview Calculation
$('#balanceAction, #amount').on('change keyup', function() {
    const action = $('#balanceAction').val();
    const amount = parseFloat($('#amount').val()) || 0;
    let preview = '';
    
    if (action && amount > 0) {
        let newBalance = currentUserBalance;
        
        switch(action) {
            case 'add':
                newBalance = currentUserBalance + amount;
                preview = `Current: USD ${number_format(currentUserBalance, 2)} + USD ${number_format(amount, 2)} = USD ${number_format(newBalance, 2)}`;
                break;
            case 'subtract':
                newBalance = currentUserBalance - amount;
                preview = `Current: USD ${number_format(currentUserBalance, 2)} - USD ${number_format(amount, 2)} = USD ${number_format(newBalance, 2)}`;
                if (newBalance < 0) {
                    preview += ' <span class="text-danger">(Negative Balance!)</span>';
                }
                break;
            case 'set':
                newBalance = amount;
                preview = `New Balance: USD ${number_format(newBalance, 2)}`;
                break;
        }
    } else {
        preview = 'Select an action to see preview';
    }
    
    $('#balancePreview').html(preview);
});

// Update Balance Form Submit
$('#updateBalanceForm').on('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        _token: $('input[name="_token"]').val(),
        action: $('#balanceAction').val(),
        amount: $('#amount').val(),
        reason: $('#reason').val()
    };
    
    $.ajax({
        url: '/admin/users/' + currentUserId + '/update-balance',
        method: 'POST',
        data: formData,
        success: function(response) {
            $('#updateBalanceModal').modal('hide');
            toastr.success('Balance updated successfully!');
            location.reload();
        },
        error: function(xhr) {
            const errors = xhr.responseJSON.errors;
            let errorMessage = 'Error updating balance:';
            
            if (errors) {
                Object.keys(errors).forEach(key => {
                    errorMessage += '\n- ' + errors[key][0];
                });
            }
            
            toastr.error(errorMessage);
        }
    });
});

// Other Functions
function viewUser(userId) {
    window.location.href = '/admin/users/' + userId;
}

function editUser(userId) {
    window.location.href = '/admin/users/' + userId + '/edit';
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        $.ajax({
            url: '/admin/users/' + userId,
            method: 'DELETE',
            data: {
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                toastr.success('User deleted successfully!');
                location.reload();
            },
            error: function(xhr) {
                toastr.error('Error deleting user!');
            }
        });
    }
}

// Table Search Functionality (Client-side)
$('#tableSearch').on('keyup', function() {
    const searchTerm = $(this).val().toLowerCase();
    
    $('.user-row').each(function() {
        const row = $(this);
        const id = row.data('id').toString();
        const name = row.data('name');
        const email = row.data('email');
        const phone = row.data('phone').toString().toLowerCase();
        const country = row.data('country');
        
        const match = id.includes(searchTerm) || 
                     name.includes(searchTerm) || 
                     email.includes(searchTerm) || 
                     phone.includes(searchTerm) || 
                     country.includes(searchTerm);
        
        if (match) {
            row.show();
            // Highlight matching text
            row.find('td').each(function() {
                const cell = $(this);
                const text = cell.text();
                if (text.toLowerCase().includes(searchTerm) && searchTerm.length > 0) {
                    cell.addClass('search-highlight');
                } else {
                    cell.removeClass('search-highlight');
                }
            });
        } else {
            row.hide();
            row.find('td').removeClass('search-highlight');
        }
    });
    
    // Show/hide empty state
    const visibleRows = $('.user-row:visible').length;
    if (visibleRows === 0) {
        $('#usersTable tbody').append(`
            <tr id="no-results-row">
                <td colspan="9" class="text-center py-4">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No results found for "${searchTerm}" in table</p>
                    <button class="btn btn-sm btn-secondary" onclick="$('#tableSearch').val('').trigger('keyup')">
                        Clear Search
                    </button>
                </td>
            </tr>
        `);
    } else {
        $('#no-results-row').remove();
    }
});

// Clear table search when clicking clear in form search
$('#search_field, #search').on('change keyup', function() {
    $('#tableSearch').val('').trigger('keyup');
});

// Auto-submit form when search field changes
$('#search_field').on('change', function() {
    if ($('#search').val().trim()) {
        $('#searchForm').submit();
    }
});

// Number formatting helper function
function number_format(number, decimals = 2) {
    return parseFloat(number).toLocaleString('en-US', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals
    });
}

// Initialize tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    
    // Auto-focus search input
    @if($search)
        $('#search').focus();
    @endif
});
</script>
@stop