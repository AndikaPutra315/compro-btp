{{-- Recursive org-tree partial --}}
<div class="org-tree">
    <ul>
        @foreach($nodes as $node)
        <li>
            <div class="org-node">
                <div class="node-title">{{ $node->jabatan }}</div>
                <div class="node-name">{{ $node->nama }}</div>
            </div>
            @if($node->children->isNotEmpty())
                @include('admin.organization._tree', ['nodes' => $node->children])
            @endif
        </li>
        @endforeach
    </ul>
</div>
