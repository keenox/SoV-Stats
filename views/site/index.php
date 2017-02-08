<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
		<h1>Sound of Vision statistics</h1>
        <div class="row">
            <div class="col-lg-6">
<?php
			do
			{
				$userId = rand(1, 10);
				$taskId = rand(1, 12);
				
				$scores = (new \yii\db\Query())
									->select('users.name, tasks.description, score.value, trials.end_time')
									->from('users, tasks, score, tests, trials')
									->where('users.id=tests.user_id and score.trial_id=trials.id and trials.test_id=tests.id AND users.id=:id_user and tasks.id=:id_task', 
										[
											'id_user' => $userId,
											'id_task' => $taskId
										]
									)
									->orderBy('trials.end_time ASC')
									//->orderBy('score.value ASC') // hack pretty evolution
									->all();
			}
			while (!is_array($scores) or empty($scores));
			
			$userName = $scores[0]['name'];
			$taskName = $scores[0]['description'];
								
            echo "<h3>Scores over time<br/>(user: ${userName}, task: ${taskName})</h3>\n";
			
            use scotthuangzl\googlechart\GoogleChart;
			
			// transform to time-score only
			$scores = array_map(function($val) { return [$val['end_time'], intval($val['value'])];}, $scores);
			$data = array_merge(array(array('Time', 'Score')), $scores);
			
			//var_dump($data);
 
            echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => array_merge(array(array('Time', 'Score')), $scores),
				'options' => ['width' => '100%',
							  'height' => '100%']
                ));
								
			//var_dump($scores);
			
?>
            </div>
            <div class="col-lg-6">
                <h3>Most played scenes</h3>

<?php
			$topScenes = (new \yii\db\Query())
								->select('scenes.name, count(trials.id) as total')
								->from('scenes, trials')
								->where('trials.scene_id = scenes.id')
								->groupBy('scenes.id')
								->orderBy('total DESC')
								->all();

			
			//var_dump($topScenes);
			$topScenes = array_map(function($val) { return [$val['name'], intval($val['total'])];}, $topScenes);
 
            echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array_merge(array(array('Scene', 'Times played')), $topScenes),
				'options' => ['width' => '100%',
							  'height' => '100%']
                ));
								
			//var_dump($scores);
			
?>
				
                
            </div>
        </div>
		<div class="row">
            <div class="col-lg-6">
<?php
		
				do
				{
						
					$sceneId = rand(1,10);

					$topPlayers = (new \yii\db\Query())
									->select('users.name as uname, sum(score.value) as total, scenes.name as sname')
									->from('score, trials, users, scenes, tests')
									->where('trials.scene_id = scenes.id and score.trial_id = trials.id and trials.test_id = tests.id and tests.user_id = users.id and scenes.id = :id', ['id' => $sceneId])
									->groupBy('users.name')
									->orderBy('total DESC');
					
				} while($topPlayers->count() == 0);
			
				$mapName = $topPlayers->one()['sname'];
				echo "<h3>Top players by scene (${mapName})</h3>";
				
				
				use yii\grid\GridView;
				use yii\data\ActiveDataProvider;

				$dataProvider = new ActiveDataProvider([
					'query' => $topPlayers,
					'pagination' => [
						'pageSize' => 20,
					],
				]);
				echo GridView::widget([
					'dataProvider' => $dataProvider,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],
						['attribute' => 'uname', 'label' => 'User name'],
						['attribute' => 'total', 'label' => 'Score'],
						]
					]);
								
?>
            </div>
            <div class="col-lg-6">
                <h3>Users by age</h3>

<?php
			$userAge = (new \yii\db\Query())
								->select('users.age, count(users.id) as total')
								->from('users')
								->groupBy('users.age')
								->orderBy('users.age ASC')
								->all();

			
			$userAge = array_map(function($val) { return [$val['age'], intval($val['total'])];}, $userAge);
 
            echo GoogleChart::widget(array('visualization' => 'AreaChart',
                'data' => array_merge(array(array('Age', 'Count')), $userAge),
				'options' => ['width' => '100%',
							  'height' => '100%']
                ));
?>
                
            </div>
        </div>

    </div>
</div>
