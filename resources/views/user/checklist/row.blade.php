<tr>
    <td>{{ $caption }}</td>
    <td style="width: 0px; padding-right: 1.5rem">
        <div class="form-check ">
            <input disabled class="form-check-input" type="checkbox" value=""
                {{ Auth::user()->topic > $topic ? 'checked' : '' }}
                style="width: 30px; height: 30px; padding-right: 0.5rem">
        </div>
    </td>
</tr>
