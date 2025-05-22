@forelse ($blogs as $key => $blog)
<tr>
    <td>{{$key+$blogs->firstItem()}}</td>
    <td><img src="{{asset('storage/app/public/admin_feature')}}/{{ $blog['image'] ?? null }}" width="100px" height="100"></td>
    <td>
    <span class="d-block font-size-sm text-body">
        {{$blog['post_title']}}
    </span>
    </td>
    <td>
        {{$blog['slug']}}
    </td>
    <td>
        {{ date('Y-m-d h:i:s', $blog['time_id']) }}
    </td>
    <td >
        <div class="btn--container justify-content-center">
      
            <a  href="{{route('admin.blog.edit', $blog['id']) }}" class="btn btn-sm btn--primary btn-outline-primary action-btn">
                <i class="tio-edit"></i>
            </a>
           
            
        </div>
    </td>
</tr>
@empty

@endforelse
