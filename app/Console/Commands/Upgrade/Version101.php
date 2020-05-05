<?php

namespace App\Console\Commands\Upgrade;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Version308 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:version1.0.1 {--op=operation:[addTables,updateTables,deleteTables]} {--updateStep=xxx:[xxx,xxx1,xxx2,xxx3]}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1.0.1数据库更改命令';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $op = $this->option('op');
        switch ($op) {
            case 'addTables':
                $this->addTables();
                break;
            case 'updateTables':
                $this->updateTables();
                break;
            case 'deleteTables':
                $this->deleteTables();
                break;
            default:
                $this->error('没有这个操作，请添加op参数');
                break;
        }
    }

    public function addTables()
    {
        // 题目表
        $tableName = 'questions';
        $this->info("新增{$tableName}表");
        if (Schema::hasTable($tableName)) {
            $this->error("{$tableName}表已存在");
        } else {
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->string('picture')->comment('题目图片');
                $table->tinyInteger('subject')->comment('学科，1：语文，2：数学，3：英语');
                $table->tinyInteger('grade')->comment('年级，1到9');
                $table->tinyInteger('semester')->comment('学期，1：上学期，2：下学期');
                $table->text('remarks')->nullable()->comment('备注');
                $table->timestamps();
            });
        }

        // 题目-学生表
        $tableName = 'question_student';
        $this->info("新增{$tableName}表");
        if (Schema::hasTable($tableName)) {
            $this->error("{$tableName}表已存在");
        } else {
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('question_id')->comment('题目id');
                $table->integer('student_id')->comment('学生id');
                $table->timestamps();
            });
        }

        // 试卷表
        $tableName = 'exams';
        $this->info("新增{$tableName}表");
        if (Schema::hasTable($tableName)) {
            $this->error("{$tableName}表已存在");
        } else {
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->comment('学生id');
                $table->tinyInteger('subject')->comment('学科，1：语文，2：数学，3：英语');
                $table->string('questions')->comment('题目数组');
                $table->timestamps();
            });
        }

        // 试卷表
        $tableName = 'exam_comments';
        $this->info("新增{$tableName}表");
        if (Schema::hasTable($tableName)) {
            $this->error("{$tableName}表已存在");
        } else {
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->comment('学生id');
                $table->integer('exam_id')->comment('试卷id');
                $table->tinyInteger('rate')->comment('正确率，1：100%，2：90%以上，3：80%以上，4：70%以上，5：60%以上，6：60%以下');
                $table->string('picture')->comment('试卷图片');
                $table->text('comment')->comment('点评');
                $table->timestamps();

                // 试卷id唯一索引
                $table->unique('exam_id');
            });
        }
    }

    public function updateTables()
    {
        /**
         * 杨锦涛
         */
        $tableName = 'homework_help';
        $this->info("修改{$tableName}表");
        if (Schema::hasTable($tableName)) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->tinyInteger('kind')->nullable()->comment('类型  1=午间作业辅导  2=晚间作业辅导');
                $table->tinyInteger('complete_status')->nullable()->comment('1=自己完成  2=代替完成');
                $table->integer('instead_type')->nullable()->comment('代替完成人角色类型');
                $table->integer('instead_type_id')->nullable()->comment('替代完成人详情id');
            });
        } else {
            $this->error("{$tableName}表不存在");
        }

        $tableName = 'nobook_school';
        $this->info("修改{$tableName}表");
        if (Schema::hasTable($tableName)) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->integer('user_id')->nullable()->comment('上报人账号id');
            });
        } else {
            $this->error("{$tableName}表不存在");
        }

        $tableName = 'task_detail';
        $this->info("修改{$tableName}表");
        if (Schema::hasTable($tableName)) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->tinyInteger('complete_status')->nullable()->comment('1=自己完成  2=代替完成');
                $table->integer('instead_type')->nullable()->comment('代替完成人角色类型');
                $table->integer('instead_type_id')->nullable()->comment('替代完成人详情id');
            });
        } else {
            $this->error("{$tableName}表不存在");
        }
    }

    public function deleteTables()
    {
        // Do nothing
    }
}
