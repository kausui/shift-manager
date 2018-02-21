<tr>
                        <!-- ページネーション自体に日付と曜日を入れるか -->
                        <th></th>
                        @for ($i = 1; $i <= $last_day; $i++)
                            <th>{{ $i }}</th>
                        @endfor
                    </tr>
                    <tr>
                        <th></th>
                        @foreach ($days as $weekday)
                            <th class=@if( $weekday == '土')
                                            {{ 'saturday' }}
                                        @elseif( $weekday == '日')
                                            {{ 'sunday' }}
                                        @else
                                            {{ 'weekday' }}
                                        @endif
                                        >
                                {{ $weekday }}</th>
                        @endforeach
                    </tr>