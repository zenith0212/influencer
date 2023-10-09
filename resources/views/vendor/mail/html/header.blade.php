@props(['url'])
<tr>
{{-- <td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/media/logos/topbrandmate.png') }}" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td> --}}
<td class="header" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; padding: 25px 0 ; text-align: center"> <a href="{{ $url }}" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 19px ; font-weight: bold ; text-decoration: none ; display: inline-block;" target="_other" rel="nofollow"> <img style="max-width: 210px;" src="{{ asset('assets/media/logos/topbrandmate.png') }}" alt=""> </a> </td>
</tr>
