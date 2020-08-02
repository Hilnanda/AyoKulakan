<div class="ui three column row">
  <div class="column">
    <div class="ui segment">
      {!! $barChart->render() !!}
    </div>
  </div>
  <div class="column">
    <div class="ui segment">
      {!! $lineChart->render() !!}
    </div>
  </div>
  <div class="column">
    <div class="ui gmf inverted padded clearing segment">
      <h1 class="ui left floated header">
        Content
      </h1>
      <div class="ui white right floated button">Good</div>
    </div>
    <h3 class="ui horizontal divider header">
      <i class="bar chart icon"></i>
      Statistic
    </h3>
    <div class="ui padded clearing segment">
      <h1 class="ui left floated header">
        Content
      </h1>
      <div class="ui gmf right floated button">Bad</div>
    </div>
  </div>
</div>
