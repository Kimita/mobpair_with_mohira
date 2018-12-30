# 2018-12-29 レビュー用資料 on「モブプロ・ペアプロ会 with mohira」

## 1. はじめに

本リポジトリは、掲題のイベントで [資料「TDDBC課題：ポーカー」](http://devtesting.jp/tddbc/?TDDBC仙台07%2F課題) における「課題1-1 カードの文字列表記」に対してPHPerペアが取り組んだ成果物の変遷を履歴として持つリポジトリです。

### リポジトリの構成

composer create-project によって生成されたLaravel5.5系のプロジェクトの構成物をベースにして、次のようなディレクトリ構成になっています。

```
### Laravel5.5系プロジェクトの標準構成物 + α ###

projectDir/
  ├ app/
  │  ├ ～～省略～～
  │  ├ Domain/              ← レビュー対象
  │  └ ～～省略～～
  ├ ～～省略～～
  ├ docs/
  │  ├ analyze/             ← レビュー対象
  │  └ usecase/             ← レビュー対象
  ├ ～～省略～～
  ├ tests/
  │  ├ ～～省略～～
  │  ├ Unit/
  │  │   └ Poker/           ← レビュー対象
  │  └ ～～省略～～
  ├ ～～省略～～
  └ phpunit.xml

```

## 2. レビュー

### 2-1. 図の作成意図

課題の示す規模のプログラムを書くのに
「ユースケース図やロバストネス図を作ってDDD風の実装設計をする」という作業は仰々しいと言ってしまえばそうなのですが、
課題の示す一覧を俯瞰して見た時、すべての課題が **「Pokerというゲームをプレイヤーが遊ぶための部品作りに順を追って取り組んでいく」** という文脈を持っていると見受けました。

部品ということは、いずれPokerというゲームを実現するシステムに組み込んで使うでしょうから、
システムにおける位置づけを適切なnamespaceで表現しておくことは「最初にやっておくべきこと」のように思われましたので、上記の仰々しい作業に遠慮なく取り組むことにしました。

*(※ペアとなったPHPersがそれぞれ「横メロン農家を最近始めた」という似た境遇にあったため上記の目的をこじつけただけ、という説もあり)*

### 2-2. 図の解説

/docs/配下の図を、次の順に御覧ください。

1. /docs/usecase/ユーザがシステムを操作.png
2. /docs/analyze/プレイヤーの手持ちカードの文字列表記を問い合わせる.png
3. /docs/analyze/カード一枚の文字列表記を返す.png

最初のユースケース図「ユーザがシステムを操作」で示した内容のうち、
ユーザが行う「カードの文字列表記を取得」という処理をロバストネス分析してその先の各ユースケースをロバストネス図化したものが
/docs/analyze/配下
へ配置してあります。

提示したユースケース図や２つのロバストネス図は、システム内部のプロセスの関係性を次のように示唆しており、ユースケース記述の作成を代替しています。

*(※ユースケース記述に相当する「文言メインの文書」を作ると、図に変更が生じる時に修正が面倒なので書きたくないという怠惰が発動しただけ、という説は認めない)*

* 完成するシステムではおそらく各々次のような責務を持つドメインモデルが存在するはず。
    * **ドメインモデル「Trump」: カード集合の状態を扱う**
        * 全カードを表現するコレクションのようなデータ構造の中で、次のような振る舞いを持つ可能性が見込まれる
            * プレイヤーに配布済みのカードは、配布元である「スタックされたカード集合」中に無いことを保証する
            * スタックされたカード集合の上から一枚ずつ取り出す
            * スタックされたカード集合の中からいずれか一枚を抜き出す
            * カードのスタックをシャッフルする
        * カード集合から取り出された一枚のカードについての属性情報を表現する
            * スート(suit)を取り出す
            * ランク(rank)を取り出す
            * suitとrankを連結して取り出す
            * ゲームが変われば、「折れ曲がっている」とか「裏返しである」といった状態も持つかもしれない
    * **ドメインモデル「Poker」: Pokerゲームの進行を司る**
        * PlayerやDealerの行う操作や関係性を扱う
            * DealerがTrumpモデルからカードEntityをPlayerへ配布する
            * １ゲーム毎のライフサイクル(「◯回勝負を行う」とか)を扱うことにもなるであろう
            * 勝敗情報を蓄積し、成績データを持つことも考えられる
        * 各Playerが手元に持っているカード集合のスタックそのものや相関を扱うことになると思われる
            * 各Playerの手札数
            * Playerの持つ手札の役を判定する
            * Playerの手札間の勝敗を判定する
* 以上を踏まえて、Domainネームスペース配下には「Poker」と「Trump」というネームスペースを置いた方が良さそう。
* また、図より今回の課題である「カードの文字列表記」を取得する処理は、ゆくゆくはシステム内部で次のような「クライアント」と「クライアントが利用する処理」を持つと見ることができるようになった。
    * システム内部第一層
        * クライアント(Actor)  :システム
        * 利用する処理(Control):Pokerパッケージ内部のPlayerエンティティの持つ「Card一枚を取得するメソッド」
    * システム内部第二層
        * クライアント(Actor)  :Playerエンティティ
        * 利用する処理(Control):Trumpパッケージ内Cardエンティティの持つ「カードの文字列表記を取得するメソッド」

### 2-3. 図示した概念をDomainモデルのクラス設計へ反映

上記の最後にてControlとして表現される処理を各boundary(境界)と対応するInterfaceへメソッドとして定義すれば、
いよいよ「具象クラスが未実装だろうと、Interfaceの組み立てだけで『テストしたいこと』をコードとして表現する」ための下地が出来た、と言えるのではないでしょうか。
つまりこれは「テスト駆動開発」プロセスが理想的に進んでいるということでは？！

というわけで、各boundaryの持つメソッドをInterfaceとして配置したのが
/app/Domain/配下の各種コードです。
また、それら配置済みのInterfaceを使って書いたテストコードが
/tests/Unit/Poker/配下のコードです。

テストコードは、PHP7.2以上が動作する環境であれば次のようなコマンドで動作します。
※ ただし、composer install を予め実行しておく必要はあります。(composerの使い方についての説明は割愛します)
> $ php vendor/bin/phpunit tests/Unit

次のように「--debug」オプションを付けると、phpunitがdebugモードでの出力も行ってくれます。
> $ php vendor/bin/phpunit tests/Unit --debug



## 最後に

実際のプロジェクトではこの後「ロバストネス図からシーケンス図やクラス図を生成」というプロセスを経て具象クラスの実装が始まるものと思われますが、まだそこは把握できてないのでやっていません。

以上が、「テスト駆動開発のための設計」に取り組んだ結果のレビュー内容となります。
ご査収ください。


*※なお、上記の「Domainネームスペース」は今回の作業上の都合でLaravel標準構成中の/app/配下に放り込んであるが、コード的には完全にLaravelの管轄するディレクトリ構成の外に置くことができる(composer.jsonに一工夫入れれば)ということを、申し添えておきます*


