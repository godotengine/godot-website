# OctoberCMS Agent Plugin

PHP側でユーザのブラウザ、OS、デバイスを判定するための [OctoberCMS](http://octobercms.com/) 用プラグインです。
PHPだけでなくTwigテンプレートからも利用できます。

このプラグインは [jenssegers/agent](https://github.com/jenssegers/agent) のタダのラッパーです。
jenssegers さんと更にその[ベース](https://github.com/serbanghita/Mobile-Detect) を作った serbanghita さんに感謝です。


## API
利用可能なAPIはこちら[jenssegers/agent](https://github.com/jenssegers/agent)を参考にしてください。


## 使い方
### インストール
comopserと管理画面（バックエンドUI）のどちらからでもインストールが可能です。

#### composerの場合
プロジェクトルートから下記を実行します。
```
composer require pikanji/agent-plugin
```

#### UIからの場合
* 管理画面にログインします。
* Settings > Updates & Plugins と開きます。
* "Install plugins"ボタンをクリックします。
* 検索ボックスに"Agent"と入力すると候補にこのプラグインが表示されます。
* 候補からAgentを選択するとインストールが始まります。


### Twigテンプレートからの利用
ページやレイアウトにコンポーネントを追加するだけで利用できます。
レイアウトに追加すれば、ページごとに追加する必要が無いのでおすすめです。


まず、準備はレイアウトの設定セクションに `[Agent]` を記述するだけです。Agentプラグイン自体の設定は何もありません。

```
description = "Default layout"

[Agent]
==
<!DOCTYPE html>
...

```

そして、テンプレートから下記のように利用できます。
```
...
{% if Agent.isFireFox() %}
...
```

### PHPからの利用
`use Agent;` 入れて `Agent` ファサードからメソッドを呼び出せます。

```php
use Agent;
...

if (Agent::isFireFox()) {
...
```

ちなみに、ファサードを使わない場合は、基本的にはこのようになります。
```php
use Jenssegers\Agent\Agent;
...

$agent = new Agent();
if ($agent->isFireFox()) {
...

```

[jenssegers/agent](https://github.com/jenssegers/agent) を直接使うだけなので、そちらの README を参考にしてください。
依存関係としてすでにインストールされているので別途インストールする必要はありません。
