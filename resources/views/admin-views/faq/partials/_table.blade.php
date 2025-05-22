@forelse ($faqs as $key => $faq)
<tr>
    <td>{{ $key + $faqs->firstItem() }}</td>
    
    
    <td>
        <span class="d-block font-size-sm text-body">
            {{ Str::limit($faq->question, 50) }}
        </span>
    </td>
    
    <td>
        {{ Str::limit($faq->answer, 50) }}
    </td>

    <td>
        @if ($faq->is_active == 'Y')
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>
    
    <td>
        {{ $faq->created_at->format('Y-m-d H:i:s') }}
    </td>
    
    <td>
        <div class="btn--container justify-content-center">
            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-sm btn--primary btn-outline-primary action-btn">
                <i class="tio-edit"></i>
            </a>

            <!-- <a href="{{ route('admin.faq.delete', $faq->id) }}" class="btn btn-sm btn--danger btn-outline-danger action-btn" onclick="return confirm('Are you sure you want to delete this FAQ?')">-->
            <!--    <i class="tio-delete-outlined"></i>-->
            <!--</a> -->
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center">No FAQs found.</td>
</tr>
@endforelse
