
@includeWhen(auth()->user()->isAdmin(),    'dashboard.dashboard_admin')
@includeWhen(auth()->user()->isWorkshop(), 'dashboard.dashboard_workshop')
@includeWhen(auth()->user()->isCustomer(), 'dashboard.dashboard_customer')

