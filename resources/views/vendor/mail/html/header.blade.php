<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'header')
                <img src="{{ asset('web/assets/images/icon.png') }}" style="width: 70px;height:70px">
            @else
                <img src="{{ asset('web/assets/images/icon.png') }}" style="width: 70px;height:70px">
            @endif
        </a>
    </td>
</tr>
