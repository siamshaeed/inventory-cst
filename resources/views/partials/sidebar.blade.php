
@includeWhen(auth()->user()->isAdmin(),    'partials.sidebars.admin')
@includeWhen(auth()->user()->isWorkshop(), 'partials.sidebars.workshop')
@includeWhen(auth()->user()->isCustomer(), 'partials.sidebars.user')
