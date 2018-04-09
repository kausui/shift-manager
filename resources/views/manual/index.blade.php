@extends('layouts.app')

@section('content')
         
        <h2>シフトマネージャーの使い方</h2>
 
 
        <div class="tocbox">
            <h3>目次</h3>
            <ol>
                <li><a href="#user_manager_reg">ユーザ（管理者）登録</a></li>
                <li><a href="#user_manager_edit">ユーザ（管理者）情報の編集</a></li>
                <li><a href="#office_edit">事務所情報の編集</a>
                    <ol>
                        <li><a href="#edit_required_staff">時間ごとの必要従業員数の編集</a></li>
                        <li><a href="#reg_staff">従業員の登録</a></li>
                    </ol>
                </li>
                <li><a href="#staff">従業員について</a>
                    <ol>
                        <li><a href="#edit_staff">従業員情報の編集</a></li>
                        <li><a href="#available_reg">出勤可能日時の登録</a></li>
                        <li><a href="#shift_reg">勤務シフトの登録</a></li>
                    </ol>
                </li>
                <li><a href="#check_shift">勤務シフトの確認</a>
                    <ol>
                        <li><a href="#shift_month">今月の勤務シフトを確認する</a></li>
                        <li><a href="#shift_specific">指定した年月日の勤務シフトを確認する</a></li>
                    </ol>
                </li>
            </ol>
        </div>
        
        <h3 id="user_manager_reg">ユーザ（管理者）登録</h3>
        <p>シフトマネージャーを利用するためにはまずユーザ登録が必要です。最初の画面中央の「シフト管理を始める」もしくは右上の「新規登録」クリックしてユーザ登録画面に移ります。</p>
        <img src="{{ secure_asset('images/manual/top_nologin.jpg') }}" class="img-responsive manual">
        <p>ユーザ登録と同時にユーザが所属する事業所が新規に作成されユーザの権限はmanagerとなります。manager権限のユーザは事業所の情報修正や事業所に所属するユーザの登録、編集が行えます。</p>
        
        <h3 id="user_manager_edit">ユーザ（管理者）情報の編集</h3>
        <p>ユーザ登録が完了すると自動的にログインしてトップページに遷移します。画面右上のメニューから「マイページ」を選択します。</p>
        <img src="{{ secure_asset('images/manual/menu_loggedin.jpg') }}" class="img-responsive manual">
        <p>自身のユーザ情報のページに遷移します。従業員情報の編集ボタンを押します。</p>
        <img src="{{ secure_asset('images/manual/mypage_initial_edit_staff.jpg') }}" class="img-responsive manual">
        <p>ユーザ情報の編集ページに遷移します。項目を編集後に「更新ボタン」を押すことで設定が反映されます。以下は各項目の説明になります。</p>
        <table class="table table-bordered ">
          <thead>
            <tr>
              <th>項目</th>
              <th>意味</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>アカウント名</td>
              <td>このアカウントの名前です。ログイン後に右上に表示される名前です。</td>
            </tr>
            <tr>
              <td>姓</td>
              <td>ユーザの名前の姓です。勤務シフト一覧に表示されます。</td>
            </tr>
            <tr>
              <td>名</td>
              <td>ユーザの名前の姓です。勤務シフト一覧に表示されます。</td>
            </tr>
            <tr>
              <td>Eメールアドレス</td>
              <td>ユーザのEメールアドレスです。ログイン時に使用されます。</td>
            </tr>
            <tr>
              <td>1ヵ月の最大労働時間</td>
              <td>ユーザの1ヶ月間の最大の労働時間です。勤務シフトを自動生成する際に使用されます。自動生成機能はユーザの1ヶ月間の労働時間がこの値を超えないように勤務シフトを組みます。</td>
            </tr>
            <tr>
              <td>出勤日の最大労働時間</td>
              <td>ユーザの1日の最大の労働時間です。勤務シフトを自動生成する際に使用されます。自動生成機能はユーザの１日の労働時間がこの値を超えないように勤務シフトを組みます。</td>
            </tr>
            <tr>
              <td>出勤日の最低労働時間</td>
              <td>ユーザの1日の最低の労働時間です。勤務シフトを自動生成する際に使用されます。自動生成機能はユーザの１日の労働時間がこの値以上になるように勤務シフトを組みます。</td>
            </tr>
            <tr>
              <td>権限</td>
              <td>ユーザの権限です。Managerの権限を持つユーザは以下のことが行えます。
                  <ul>
                      <li>事業所情報の閲覧と編集</li>
                      <li>従業員の登録</li>
                      <li>従業員の情報の閲覧と編集</li>
                      <li>勤務シフトの閲覧、作成と編集</li>
                  </ul>
                  Viewerの権限を持つユーザは以下のことが行えます。
                  <ul>
                      <li>事業所情報の閲覧</li>
                      <li>従業員の情報の閲覧</li>
                      <li>勤務シフトの閲覧</li>
                  </ul>
              </td>
            </tr>
          </tbody>
        </table>
        
        <h3 id="office_edit">事務所情報の編集</h3>
        <h4 id="edit_required_staff">時間ごとの必要従業員数の編集</h4>
        <p>時間ごとの必要従業員数は勤務シフトの自動生成で利用されます。自動生成機能はその時間に設定された従業員の数に、勤務する従業員数が達するように勤務シフトを組みます。</p>
        
        <h4 id="reg_staff">従業員の登録</h4>
        従業員は「事業所情報」ページの「従業員登録」ボタンから行えます。登録された従業員は「Viewer」権限を持つユーザとして登録されます。登録された従業員のメールアドレス宛にパスワードが通知されます。
        
        <h3 id="staff">従業員について</h3>
        <h4 id="edit_staff">従業員情報の編集</h4>
        「従業員一覧」のリストのアカウント名をクリックすると従業員情報のページに遷移します。「従業員情報」欄の「編集」を押すと従業員情報の編集ページに遷移します。
        従業員情報で編集できる内容はユーザ（管理者）情報と同じ内容になります。
        
        <h4 id="available_reg">出勤可能日時の登録</h4>
        <p>従業員の出勤可能日時を登録できます。ここで登録した日時はシフト自動生成の時に利用されます。登録された日時以外に勤務シフトが入ることはありません。</p>
        <img src="{{ secure_asset('images/manual/available_reg.jpg') }}" class="img-responsive manual">
        <h4 id="shift_reg">勤務シフトの登録</h4>
        
        <p>手動で従業員の勤務シフトを登録できます。</p>
        <img src="{{ secure_asset('images/manual/shift_reg.jpg') }}" class="img-responsive manual">
        
        <h3 id="check_shift">勤務シフトの確認</h3>
        <h4 id="shift_month">今月の勤務シフトを確認する</h4>
        <p>今月の勤務シフトは右上メニューの「今月のシフト」から確認できます。また、「マイページ」からも自分の勤務シフトが確認できます。</p>
        <h4 id="shift_specific">指定した年月日の勤務シフトを確認する</h4>
        <p>特定の日付の勤務シフトは月のシフト表示から「&lt;」（1ヶ月前のシフト表示）もしくは「&gt;」（1ヶ月次のシフト表示）で確認したい年月のシフト表に移動して確認できます。詳細を確認するには今日の日付をクリックします。</p>
        
        <p>また、アドレスを直接入力することで特定の年月日のシフトを表示できます。例えば2018年3月の勤務シフトを確認するには以下のアドレスを入力します。</p>
        <blockquote>https://shift-manager-d2vm.herokuapp.com/shifts/2018/3</blockquote>
        <p>2018年3月16日の勤務シフトを確認するには以下のアドレスを入力します。</p>
        <blockquote>https://shift-manager-d2vm.herokuapp.com/shifts/2018/3/16</blockquote>
        
@endsection