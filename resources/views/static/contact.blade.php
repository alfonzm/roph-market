@extends('static-layout')

@section('title', 'Contact Us')

@section('static-content')
<p>
If you find any bugs or have any questions/suggestions, please e-mail us at:
</p>
<p>
<a href="mailto:{{ env('CONTACT_EMAIL', 'ragnamarketcom@gmail.com') }}">{{ env('CONTACT_EMAIL', 'ragnamarketcom@gmail.com') }}</a>
</p>

<p>
Or message us on our Facebook page:
</p>
<p>
<a target="_blank" href="{{ env('CONTACT_FB_PAGE', '#') }}">Ragna Market Facebook page</a>
</p>
@endsection