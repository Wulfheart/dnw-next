<?php

namespace App\Actions\Game;

/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob()
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean)
 * @method static void dispatchSync()
 * @method static void dispatchNow()
 * @method static void dispatchAfterResponse()
 * @method static mixed run()
 */
class CreateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $game_id, bool $save_response)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $game_id, bool $save_response)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $game_id, bool $save_response)
 * @method static void dispatchSync(int $game_id, bool $save_response)
 * @method static void dispatchNow(int $game_id, bool $save_response)
 * @method static void dispatchAfterResponse(int $game_id, bool $save_response)
 * @method static mixed run(int $game_id, bool $save_response)
 */
class InitializeGameAction
{
}
namespace Lorisleiva\Actions\Concerns;

/**
 * @method void asController()
 */
trait AsController
{
}
/**
 * @method void asListener()
 */
trait AsListener
{
}
/**
 * @method void asJob()
 */
trait AsJob
{
}
/**
 * @method void asCommand(\Illuminate\Console\Command $command)
 */
trait AsCommand
{
}