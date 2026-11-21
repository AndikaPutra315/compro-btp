{{-- Recursive org chart node partial for the public landing page --}}
<div class="org-chart">
    <ul>
        @foreach($nodes as $node)
        <li>
            <div class="org-node-card">
                <div class="org-node-header">{{ $node->jabatan }}</div>
                <div class="org-node-body">{{ $node->nama }}</div>
            </div>
            @if($node->children->isNotEmpty())
                @include('partials.org-chart-node', ['nodes' => $node->children])
            @endif
        </li>
        @endforeach
    </ul>
</div>
