<script>
    window.CONFIG = {
        ROUTES : {
            'admin_dashboard' : "{{ route('admin.dashboard') }}",
            'brand_dashboard' : "{{ route('brand_dashboard') }}",
            'influencer_dashboard' : "{{ route('influencer_dashboard') }}",
            'admin_login' : "{{ route('login') }}",
            'brand_users' : "{{ route('brands.users') }}",
            'influencer_users' : "{{ route('influencers.users') }}",
            'view_influencer' : "{{ route('influencer.get_influencer', ['']) }}",
            'search_influencers' : "{{ route('brand.get_influencer') }}",
            'search_campaign' : "{{ route('influencer.get_campaign') }}",
            'search_connected_campaign' : "{{ route('influencer.get_connected_campaign') }}",
            'search_product' : "{{ route('influencer.get_product') }}",
            'sent_invitation' : "{{ route('brand.send_invitation') }}",
            'load_influencer' : "{{ route('brand.loadmore_influencers') }}",
            'delete_influencer' : "{{ route('admin.delete_influencers') }}",
            'delete_brand' : "{{ route('admin.delete_brand', ['']) }}",
            'edit_brand_users' : "{{ route('brand.edit', ['']) }}",
            'registed_influencers' : "{{ route('get_register_influencers') }}",
            'accept_request' : "{{ route('brand.campaign.accept_request') }}",
            'reject_request' : "{{ route('brand.campaign.reject_request') }}",
            'accept_offer'  : "{{ route('influencer.campaign.accept_offer') }}",
            'reject_offer'  : "{{ route('influencer.campaign.reject_offer') }}",
            'negociate_request' : "{{ route('influencer.negociate_request') }}",
            'complete_offer' : "{{ route('influencer.complete_offer') }}",
            'payment_request' : "{{ route('influencer.payment_request') }}"
        },
        user_id : "{{ Auth::id() }}",
        public_assets : "{{ asset('') }}",
        messages : {
            no_record_found : "{{ __('themes.messages.no_record_found') }}",
        	no_contact : "{{ __('themes.messages.no_contact') }}",
        }
    }
</script>