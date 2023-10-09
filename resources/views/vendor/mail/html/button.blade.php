@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative">
<a href="{{ $url }}" class="button button-{{ $color }}" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; border-radius: 4px ; color: #fff ; display: inline-block ; overflow: hidden ; text-decoration: none ; background-color: #F26546 ; border-bottom: 8px solid #F26546 ; border-left: 18px solid #F26546 ; border-right: 18px solid #F26546 ; border-top: 8px solid #F26546" target="_other" rel="nofollow">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
