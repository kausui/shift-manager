<tr>
                        <!-- ページネーション自体に日付と曜日を入れるか -->
                        <th></th>
                        @for ($i = 1; $i <= $last_day; $i++)
                            <?php
                                if( $current_cal && $this_day == $i) {
                            ?><th class="warning text-center">
                            <?php
                                } else {
                                    ?><th class="text-center">
                                        <?php
                                }
                                ?>
                            {!! link_to_route('shifts_year_month_day.get', $i, ['year' => $year, 'month' => $month, 'day' => $i], null) !!}</th>
                        @endfor
                    </tr>
                    <tr>
                        <th></th>
                        <?php
                            $j = 1;
                        ?>
                        @foreach ($days as $weekday)
                        <?php
                            if ($weekday == '土')
                            {
                                $class = 'saturday text-center';
                            } elseif ($weekday == '日') {
                                $class = 'sunday text-center';
                            } else {
                                $class = 'weekday text-center';
                            }
                            
                            if ( $current_cal && $this_day == $j) {
                                $class = $class . ' warning';
                            }
                        ?>
                            <th class="<?php echo $class ?>">
                                {{ $weekday }}</th>
                            <?php
                            $j++;
                            ?>
                        @endforeach
                    </tr>