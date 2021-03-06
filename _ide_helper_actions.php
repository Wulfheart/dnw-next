<?php

namespace App\Actions\Game;

/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static dispatchSync(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static dispatchNow(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static dispatchAfterResponse(int $game_id, bool $save_response = false, bool $send_emails = true)
 * @method static mixed run(int $game_id, bool $save_response = false, bool $send_emails = true)
 */
class AdjudicateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob()
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean)
 * @method static dispatchSync()
 * @method static dispatchNow()
 * @method static dispatchAfterResponse()
 * @method static mixed run()
 */
class AutomaticAdjudicationAtPhaseEndAction
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
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static dispatchSync(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static dispatchNow(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static dispatchAfterResponse(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 * @method static \App\Models\Game run(\App\Models\User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async, int $message_mode_id)
 */
class CreateGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static dispatchSync(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static dispatchNow(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static dispatchAfterResponse(\App\Models\Game $game, array $winners, bool $send_email = true)
 * @method static mixed run(\App\Models\Game $game, array $winners, bool $send_email = true)
 */
class FinishGameAction
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
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob()
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch()
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean)
 * @method static dispatchSync()
 * @method static dispatchNow()
 * @method static dispatchAfterResponse()
 * @method static mixed run()
 */
class RememberUsersToOrderAction
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
class StartGameAction
{
}
namespace App\Actions\Game\Fake;

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
class FakeFillGameAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(\App\Models\Game $game, bool $ready)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(\App\Models\Game $game, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(\App\Models\Game $game, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, \App\Models\Game $game, bool $ready)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, \App\Models\Game $game, bool $ready)
 * @method static dispatchSync(\App\Models\Game $game, bool $ready)
 * @method static dispatchNow(\App\Models\Game $game, bool $ready)
 * @method static dispatchAfterResponse(\App\Models\Game $game, bool $ready)
 * @method static mixed run(\App\Models\Game $game, bool $ready)
 */
class FakeOrdersAction
{
}
/**
 * @method static \Lorisleiva\Actions\Decorators\JobDecorator|\Lorisleiva\Actions\Decorators\UniqueJobDecorator makeJob(string $seed)
 * @method static \Lorisleiva\Actions\Decorators\UniqueJobDecorator makeUniqueJob(string $seed)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(string $seed)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchIf(bool $boolean, string $seed)
 * @method static \Illuminate\Foundation\Bus\PendingDispatch|\Illuminate\Support\Fluent dispatchUnless(bool $boolean, string $seed)
 * @method static dispatchSync(string $seed)
 * @method static dispatchNow(string $seed)
 * @method static dispatchAfterResponse(string $seed)
 * @method static void run(string $seed)
 */
class FakeSeedGameWithOrdersAction
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