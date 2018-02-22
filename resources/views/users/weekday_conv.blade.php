@if( $availability->weekday == 0 )
    日
@elseif( $availability->weekday == 1 )
    月
@elseif( $availability->weekday == 2 )
    火
@elseif( $availability->weekday == 3 )
    水
@elseif( $availability->weekday == 4 )
    木
@elseif( $availability->weekday == 5 )
    金
@elseif( $availability->weekday == 6 )
    土
@endif