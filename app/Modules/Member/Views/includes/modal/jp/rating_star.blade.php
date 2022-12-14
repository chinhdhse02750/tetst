<div class="modal-custom__header">★マーク(評価)について</div>
<div class="modal-custom__body">
    <p>女性が希望する交際の流れについて５つの項目を設定しました。</p>
    <div class="d-block">
        @include('includes.rating', ['rating' => 100])
        <span style="font-size: .8rem">とてもオススメ</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 80])
        <span style="font-size: .8rem">オススメ</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 60])
        <span style="font-size: .8rem">問題なし</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 40])
        <span style="font-size: .8rem">包容力のある方向け</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 20])
        <span style="font-size: .8rem">上級者向け</span>
    </div>
    <p>
        面接官が判断した女性の性格評価です。<br>
        ルックスは抜きにして思いやり、真面目さ、など対人能力を評価して★の数で表してあります。
    </p>
    <p>
        ※「表示順」の項目で「評価の高い順」に並び替えることが可能です。
    </p>
    <p>
        【★評価のガイドライン】<br>
        こちらは★評価の変更をする際の社内基準をガイドライン化したものです。<br>
        実際の判断とは異なるケースもあり、女性の性格を倶楽部が完全に保証するものではありません。<br>
    </p>
    <p>
        ☑ 評価を下げるケース
    </p>
    <ol style="font-size: .8rem">
        <li>
            支店来訪に関するキャンセル<br>
            採用面接に来るまでに合計で3回以上の無断キャンセルや再スケジュールがあった場合、★2からのスタートといたします。<br>
            再撮影でのキャンセルや再スケジュールは、2回目から★1つ評価を下げます。
        </li>
        <li>
            デート確定後のキャンセル <br>
            　デート前日のキャンセルは1回につき★1つ評価を下げます。<br>
            　悪質なキャンセルの場合は、デートまでの日数問わずに★1つ評価を下げます。<br>
            　<span style="color:#c44;">
                                               ※『悪質なキャンセル』とは、常習的にキャンセルしたり、仕事ではなく私用で予定を入れた場合を指しています。<br>
                                           　※初回デートで当日キャンセルを行った場合は強制退会となります。
                                           </span>
        </li>
        <li>
            悪いフィードバックあった場合<br>
            　双方に確認を取り、明らかに女性側に問題があった場合は、1人のご意見だとしても★1つ評価を下げます。<br>
            　3人以上、性格や礼儀面等で低評価が続いた場合は、確認可否にかかわらず★1つ評価を下げます。
        </li>
        <li>
            スタッフからの連絡に対するレスポンスが遅い場合<br>
            　催促をしても1日以上返事がなく、それが2回以上続いた場合は、★1つ評価を下げます。
        </li>
    </ol>
    <p style="color:#c44;">
        ※評価を下げないケース<br>
        ・デート日当日より2日以上前のキャンセルやスケジュール変更については、★評価を下げません。<br>
        ・予め、倶楽部コメントにキャンセルの可能性について記載がある場合は、★評価を下げません。<br>
        ・悪いフィードバックを、女性へ確認することに許可いただけていない場合は、★評価を下げません。<br>
        ・ご事情があり、レスポンスが遅くなる旨を事前にご連絡いただいている場合は、★評価を下げません
    </p>
    <p>
        ☑ 評価を上げるケース
    </p>
    <ol style="font-size: .8rem">
        <li>
            スタッフからの連絡に対するレスポンスがいい場合<br>
            　殆どの返事が2時間以内に来ており、その文面も丁寧な場合は、★1つ評価を上げます。
        </li>
        <li>
            良いフィードバックが続いた場合<br>
            　3人以上連続で、礼儀や対応の良さ等の評価が高いご意見があった場合は、★1つ評価を上げます。<br>
            （ただし、★1つ評価を下げるような悪いフィードバックが無い場合のみ）
        </li>
        <li>
            特にトラブルがないデートが続いた場合<br>
            　5回以上、デートでの遅刻やキャンセル、日程変更もない場合は★1つ評価を上げます。
        </li>
    </ol>
</div>
