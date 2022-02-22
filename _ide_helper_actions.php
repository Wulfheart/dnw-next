<?php

namespace App\Actions\Game;

/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $game_id, bool $save_response = false)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $game_id, bool $save_response = false)
 * @method static dispatchSync(int $game_id, bool $save_response = false)
 * @method static dispatchNow(int $game_id, bool $save_response = false)
 * @method static dispatchAfterResponse(int $game_id, bool $save_response = false)
 * @method static mixed run(int $game_id, bool $save_response = false)
 */
class AdjudicateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\Game $game)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\Game $game)
 * @method static dispatchSync(\App\Models\Game $game)
 * @method static dispatchNow(\App\Models\Game $game)
 * @method static dispatchAfterResponse(\App\Models\Game $game)
 * @method static mixed run(\App\Models\Game $game)
 */
class CheckForAdjudicationReady
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static dispatchSync(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static dispatchNow(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static dispatchAfterResponse(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 * @method static \App\Models\Game run(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async)
 */
class CreateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $game_id, bool $save_response = false)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $game_id, bool $save_response = false)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $game_id, bool $save_response = false)
 * @method static dispatchSync(int $game_id, bool $save_response = false)
 * @method static dispatchNow(int $game_id, bool $save_response = false)
 * @method static dispatchAfterResponse(int $game_id, bool $save_response = false)
 * @method static mixed run(int $game_id, bool $save_response = false)
 */
class InitializeGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchSync(\App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchNow(\App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchAfterResponse(\App\Models\User $user, \App\Models\Game $game)
 * @method static void run(\App\Models\User $user, \App\Models\Game $game)
 */
class JoinGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\User $user, \App\Models\Game $game)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchSync(\App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchNow(\App\Models\User $user, \App\Models\Game $game)
 * @method static dispatchAfterResponse(\App\Models\User $user, \App\Models\Game $game)
 * @method static void run(\App\Models\User $user, \App\Models\Game $game)
 */
class LeaveGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $user_id, int $game_id, string $orders, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $user_id, int $game_id, string $orders, bool $ready)
 * @method static dispatchSync(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static dispatchNow(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static dispatchAfterResponse(int $user_id, int $game_id, string $orders, bool $ready)
 * @method static string run(int $user_id, int $game_id, string $orders, bool $ready)
 */
class SubmitOrdersAction
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