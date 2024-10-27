@if ($paginator->hasPages())    
<ul class="pagination">          
     @if ($paginator->onFirstPage())       
     <li class="page-item icon" aria-disabled="true" aria-label="@lang('pagination.previous')">      
	 <a class="page-link"><i class="fa fa-thin fa-chevron-left" aria-hidden="true"></i></a>         
	 </li>       
	 @else  
	 <li class="page-item icon">        
	 <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-thin fa-chevron-left" aria-hidden="true"></i></a>
	 </li>       
	 @endif        
     @foreach ($elements as $element)      
	 @if (is_string($element))       
	 <li class="page-item number" aria-disabled="true"><a class="page-link">{{ $element }}</a></li>   
	 @endif                  
	 @if (is_array($element))    
	 @foreach ($element as $page => $url)         
	 @if ($page == $paginator->currentPage())        
	 <li class="page-item number"><a class="page-link active">{{ $page }}</a></li>      
	 @else                
	 <li class="page-item number"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>    
	 @endif          
	 @endforeach   
	 @endif     
	 @endforeach      
	 @if ($paginator->hasMorePages())    
	 <li class="page-item icon">             
	 <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fa fa-thin fa-chevron-right" aria-hidden="true"></i></a>        
	 </li>      
	 @else    
	 <li class="page-item icon" aria-disabled="true" aria-label="@lang('pagination.next')">     
	 <a class="page-link"><i class="fa fa-thin fa-chevron-right" aria-hidden="true"></i></a>     
	 </li>     
	 @endif
 </ul>
 @endif